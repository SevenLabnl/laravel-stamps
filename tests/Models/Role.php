<?php

namespace SevenLab\Stamps\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use SevenLab\Stamps\LabStamps;

class Role extends Model
{

    use LabStamps;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name',
    ];

    protected $quarded = [];
}
