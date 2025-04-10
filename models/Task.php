<?php


namespace models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use models\User;

class Task extends Model {

    use SoftDeletes;
    protected $table = 'tasks'; 
    protected $fillable = ['task' , 'user_id'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];


    //Task assigned user
    public function assignedUsers(){
        return $this->belongsToMany(User::class , 'task_assignment')->withPivot('deadline', 'role_name', 'status', 'priority');
    }

    //Task created user
    public function createdUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function getName(){
       $user = User::find($this->user_id);
       return $user->firstname . ' '. $user->lastname;
    }


   



    


    
}
?>