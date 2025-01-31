<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'is_complete', 'group_id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
