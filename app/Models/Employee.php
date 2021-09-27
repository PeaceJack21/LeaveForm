<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "employees";

    protected $fillable = [
        'empId', 
        'first_name', 
        'last_name', 
        'gender', 
        'position_id', 
        'user_id',
        'eligible',
        'hire_date',
    ];

    protected $dates = [
        'hire_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getHireDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function position()
    {
        return $this->beLongsTo(Position::class);
    }
    public function user()
    {
        return $this->beLongsTo(User::class);
    }
}
