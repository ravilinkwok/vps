<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $guarded = ['id'];
    protected $fillable = [
        'name','code'
    ];
    protected $fakeColumns = [];
    public $timestamps = false;
}
