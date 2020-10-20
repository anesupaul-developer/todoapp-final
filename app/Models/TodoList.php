<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'description', 'due_date', 'is_completed'];

    protected $dates = ['due_date'];

    public function setDueDateAttribute($due_date)
    {
        $this->attributes['due_date'] = Carbon::parse($due_date)->format('Y-m-d H:i:s');
    }

    public function getDueDateAttribute($due_date)
    {
        return Carbon::parse($due_date)->format('Y-m-d H:i:s');
    }
}
