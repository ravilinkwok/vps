<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Shipu\Watchable\Traits\HasAuditColumn;

class PreRegister extends Model
{
    use HasAuditColumn;

    protected $table = 'pre_registers';
    protected $guarded = ['id'];
    protected $auditColumn = true;

    protected $fakeColumns = [];

    public function creator()
    {
        return $this->morphTo();
    }

    public function editor()
    {
        return $this->morphTo();
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->uid = $model->employee->location->code.'_'.strval(random_int(100000, 999999));
        });


    }

}
