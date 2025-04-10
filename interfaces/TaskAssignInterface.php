<?php

namespace interfaces;

interface TaskAssignInterface{


    public function createTaskToUser($user, $id);
    public function getAssignUsers($taskId);

}





?>