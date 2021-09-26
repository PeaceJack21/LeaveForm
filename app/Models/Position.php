<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "positions";

    protected $fillable = [
        'title', 'department_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function department()
    {
        return $this->beLongsTo(Department::class);
    }

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
}
