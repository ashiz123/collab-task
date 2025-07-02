<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class ProfileInfo extends Model{
    protected $table = 'profile_info';
    protected $fillable = ['user_id', 
    'avatar',
    'bio',
    'date_of_birth',
    'phone_number', 
    'address',
    'city', 
    'country', 
    'postal_code', 
    'website', 
    'social_media_links'];
    

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
