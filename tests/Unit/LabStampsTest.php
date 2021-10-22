<?php

use Carbon\Carbon;
use SevenLab\Stamps\Tests\Models\Role;
use SevenLab\Stamps\Tests\TestCase;

class LabStampsTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function it_can_create_a_model_with_stamps()
    {
        $user = $this->signInUser();
        $role = Role::query()
            ->create([
                'name' => 'Role name',
            ]);

        $this->assertArrayHasKey('created_by', $role);
        $this->assertArrayHasKey('created_at', $role);
        $this->assertArrayHasKey('updated_by', $role);
        $this->assertArrayHasKey('updated_at', $role);
        $this->assertEquals($user, $role->creator()->first());
        $this->assertEquals($user, $role->updater()->first());
    }

    /**
     * @test
     * @return void
     */
    public function it_can_create_a_model_with_stamps_should_have_created_at_now()
    {
        $this->signInUser();
        $role = Role::query()
            ->create([
                'name' => 'Role name',
            ]);

        $this->assertTrue($role->created_at !== null);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_update_updated_by_on_update()
    {
        $user = $this->signInUser();
        $role = Role::query()
            ->create([
                'name' => 'Role name',
            ]);

        $differentUser = $this->signInUser('other@7lab.nl');
        $role->name = 'New name';
        $role->save();

        $this->assertEquals($user, $role->creator()->first());
        $this->assertEquals($differentUser, $role->updater()->first());
    }

    /**
     * @test
     * @return void
     */
    public function it_should_update_updated_at_on_update()
    {
        $this->signInUser();
        $role = Role::query()
            ->create([
                'name' => 'Role name',
            ]);

        $initialDate = $role->updated_at;

        $this->assertTrue($initialDate !== null);
        $role->name = 'New name';
        $role->save();
        $afterUpdate = $role->refresh()->updated_at;

        $this->assertTrue($initialDate !== $afterUpdate);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_set_deleted_by_on_delete()
    {
        $user = $this->signInUser();
        $role = Role::query()
            ->create([
                'name' => 'Role name',
            ]);

        $differentUser = $this->signInUser('other@7lab.nl');
        $role->delete();

        $this->assertEquals($user, $role->creator()->first());
        $this->assertTrue($role->deleted_at !== null);
        $this->assertEquals($differentUser, $role->deleter()->first());
    }


    /**
     * @test
     * @return void
     */
    public function it_should_set_deleted_by_and_deleted_at_null_on_restore()
    {
        $this->signInUser();
        $role = Role::query()
            ->create([
                'name' => 'Role name',
            ]);

        $role->delete();
        $role->restore();

        $this->assertNull($role->deleted_at);
        $this->assertNull($role->deleted_by);
    }
}
