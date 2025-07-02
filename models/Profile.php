<?php

declare(strict_types=1);

namespace models;
use Illuminate\Database\Eloquent\Model;
use utils\Logger;

class Profile extends Model{

    protected $table = 'profile';


    protected $fillable = [
        'is_profile_completed',
        'is_education_completed',
        'is_skill_completed'
    ];  

    const PROFILE_COMPLETED = 60;
    const EDUCATION_COMPLETED = 20;
    const SKILL_COMPLETED = 20;

    

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getProgression(int $userId) : int{

        $profile = self::where('user_id', $userId)->first();

        if(!$profile){
            return 0;
        }
     
        return 
        ($profile->is_profile_completed ? self::PROFILE_COMPLETED : 0) +
        ($profile->is_education_completed ? self::EDUCATION_COMPLETED : 0) +
        ($profile->is_skill_completed ? self::SKILL_COMPLETED : 0);
  }

    

}

