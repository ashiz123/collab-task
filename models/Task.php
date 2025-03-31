<?php


namespace models;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    protected $table = 'tasks'; 
    protected $fillable = ['task' , 'user_id'];


    
}
?>