<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $guarded = ['id'];
    protected $fillable = [
        'statement','uid','options','correct_option'
    ];
    protected $fakeColumns = [];
    public $timestamps = false;
}
