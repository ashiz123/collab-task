<?php

 namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PredefinedSkill extends Model
{
    protected $table = 'predefined_skills';
    
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get the users that have this skill.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skills', 'skill_id', 'user_id')
            ->withTimestamps();
    }
} 