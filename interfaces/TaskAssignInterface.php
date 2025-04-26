<?php

namespace interfaces;

interface TaskAssignInterface{


    public function assignTaskToUser($user, $id);
    public function getAssignUsers($taskId);
    public function changeStatusOfAssignTask($taskId, $status);

}





?>