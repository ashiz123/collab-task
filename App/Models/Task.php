<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

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

   

    public function getPriorityBadgeClass(){
        if($this->pivot->priority === "low"){
            return "btn-primary";
        }elseif($this->pivot->priority === "medium"){
            return "btn-warning";
        }else{
            return "btn-danger";
        }
    }




   



    


    
}
?>