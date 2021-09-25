<?php

namespace App\Models;

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
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function position()
    {
        return $this->hasOne(Position::class);
    }
}
