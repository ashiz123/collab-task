<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\ProfileInfo;
use App\Models\PredefinedSkill;
use App\Models\Role;


class User extends Model{
   protected $table = 'users';
   protected $fillable = ['email', 'firstname', 'lastname', 'password', 'is_verified', 'otp', 'otp_expires'];
   protected $hidden = ['password'];
   public $timestamps = true;


   public function setPasswordAttribute($value){
      $this->attributes['password'] = password_hash($value, PASSWORD_DEFAULT);
   }

   public function checkPassword($password): bool{
      return password_verify($password, $this->password);
   }

   public function getPasswordAttribute($value){
      return $value;
   }

   public function getFullNameAttribute(){
      return $this->firstname . ' ' . $this->lastname;
   }

   public static function getAllSortedByRoleId()
    {
        return self::with('roles')->get()->sortBy(function ($user) {
            return $user->roles->first()?->pivot->role_id ?? 9999;
        });
    }

  

   public function predefinedSkills(){
      return $this->belongsToMany(PredefinedSkill::class, 'user_skills', 'user_id', 'skill_id');
      
   }

   public function roles(){
      return $this->belongsToMany(Role::class, 'user_role' , 'user_id', 'role_id');
   }

    public function getRoleTitleAttribute(){
      return $this->roles->first()?->title ?? 'No Role'; 
     }

   public function hasRole($role){
      return $this->roles()->where('title', $role)->exists();
   }

   public function hasAnyRole(array $roles){
      return $this->roles()->whereIn('title', $roles)->exists();
   }

   public function hasAlreadyAssigned(){
      return $this->roles()->exists();
   }

 
   public function getRoleAttribute(){
      return $this->roles()->first();
   }

  
   public function profileInfo(){
      return $this->hasOne(ProfileInfo::class);
   }

   public function skills(){
      return $this->hasMany(Skill::class);
   }


   public function verified(){
      return $this->is_verified === 1;
   }



   

   public static function getUserNameById($id){
      $user = self::find($id);
      return $user? $user->firstname . ' ' . $user->lastname : null;
   }
   

   public static function validateRegisterUser($email, $firstname, $lastname, $password) : Array{
      $errors = [];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         $errors[] = "Invalid email format";
      }


      $existingUser = self::where('Email', $email)->first();
      if($existingUser){
         $errors[] = "User already exit";
      }


      if(strlen($password)<6){
         $errors[] = "password length must be at least 6 characters";
      }


      if(empty($firstname)){
         $errors[] = "Firstname is required.";
      }elseif(!is_string($firstname)){
         $errors[] = "Firstname must be string";
      }elseif(strlen($firstname) > 20){
         $errors[] = "Firstname must be less than 20 characters";
      }

      if(empty($lastname)){
         $errors[] = "Lastname is required.";
      }elseif(!is_string($lastname)){
         $errors[] = "Lastname must be string";
      }elseif(strlen($lastname) > 20){
         $errors[] = "Lastname must be less than 20 characters";
      }



      return $errors;


   }


   public static function validateLoginUser($email, $password) : Array {

      var_dump($email);
      $errors = [];
     
     
      if (empty(trim($email))) {
         $errors[] = "Email is required";  
     } 


      if(empty($password)){
         $errors[] = "Password required";
      }

      return $errors;
   }


   public function assignedTasks(){
      return $this->belongsToMany(Task::class, 'task_assignment')->withPivot('id', 'deadline', 'role_name', 'status', 'priority');
   }


   public function tasks(){
      return $this->hasMany(Task::class);
   }

    //user notifications
   public function notifications(){
      return $this->hasMany(Notification::class);
   }

   public function unreadNotificationCount() {
      return $this->notifications()
          ->whereNull('read_at')
          ->count();
  }

  

    
    
   }

   ?>