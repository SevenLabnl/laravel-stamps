<?php

namespace SevenLab\Stamps\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use SevenLab\Stamps\Tests\Models\User;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['SevenLab\Stamps\StampsServiceProvider'];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function setUpDatabase()
    {
        Config::set('auth.providers.users.model', User::class);

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();

            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->labStamps();
        });
    }

    protected function signInUser($email = 'info@7lab.nl')
    {
        $user = User::query()
            ->firstOrCreate([
                'name' => '7Lab',
                'email' => $email,
            ]);

        $this->actingAs($user);

        return $user;
    }
}
