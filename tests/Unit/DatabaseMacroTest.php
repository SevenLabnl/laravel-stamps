<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SevenLab\Stamps\Tests\TestCase;

class DatabaseMacroTest extends TestCase
{
    /**
     * Test if a database table can be created with the labstamps macro.
     *
     * @test
     * @return void
     */
    public function it_can_create_a_table_with_labstamps()
    {
        Schema::create('test_schema', function (Blueprint $table) {
            $table->increments('id');
            $table->labStamps();
        });

        $columns = Schema::getColumnlisting('test_schema');

        $this->assertContains('created_by', $columns);
        $this->assertContains('updated_by', $columns);
        $this->assertContains('deleted_by', $columns);
        $this->assertContains('created_at', $columns);
        $this->assertContains('updated_at', $columns);
        $this->assertContains('deleted_at', $columns);
    }
}
