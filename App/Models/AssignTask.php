<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;


class AssignTask extends Pivot {
    protected $table = 'task_assignment';
    protected $primary = 'id';

    protected $fillable = ['status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    

}