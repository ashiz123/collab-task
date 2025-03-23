<?php

namespace interfaces;

use models\Task;

interface TaskInterface {

    public function allTasks();
    public function storeTask(Task $taskModel, string $taskName);
    public function updateTask(int $id);

}




?>