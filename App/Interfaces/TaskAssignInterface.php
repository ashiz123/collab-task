<?php

namespace App\Interfaces;

interface TaskAssignInterface{


    public function assignTaskToUser($user, $id);
    public function getAssignUsers($taskId);
    public function changeStatusOfAssignTask($taskId, $status);

}





?>