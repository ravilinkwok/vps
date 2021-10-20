<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    protected $guarded = ['id'];
    protected $fillable = [
        'name','code'
    ];
    protected $fakeColumns = [];
    public $timestamps = false;
}
