<?php

namespace SevenLab\Stamps\Database\Schema\Macros;

use Illuminate\Database\Schema\Blueprint;
use SevenLab\Stamps\LabStamps;

class StampsMacro implements MacroInterface
{
    /**
     * Bootstrap the schema macro.
     *
     * @return void
     */
    public function register()
    {
        $this->registerStamps();
    }

    private function registerStamps()
    {
        Blueprint::macro('labStamps', function () {
            $this->foreignIdFor(LabStamps::getUserClass(), 'created_by')
                ->nullable()
                ->references('id')
                ->on('users');
            $this->timestamp('created_at')->nullable();

            $this->foreignIdFor(LabStamps::getUserClass(), 'updated_by')
                ->nullable()
                ->references('id')
                ->on('users');
            $this->timestamp('updated_at')->nullable();

            $this->foreignIdFor(LabStamps::getUserClass(), 'deleted_by')
                ->nullable()
                ->references('id')
                ->on('users');
            $this->timestamp('deleted_at')->nullable();
        });
    }

}
