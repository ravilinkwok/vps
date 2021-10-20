<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
       protected $table = 'videos';
    protected $guarded = ['id'];
    protected $fillable = [
        'department_id','language_id','questions','video_url'
    ];
    protected $attributes = [
        'description' => "Test",

    ];
    protected $fakeColumns = [];
    public $timestamps = true;


    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
