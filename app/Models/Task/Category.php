<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'user_id'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
