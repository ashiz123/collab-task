<?php

namespace interfaces;

use models\Task;

interface TaskInterface {

    public function allTasks();
    public function storeTask( string $taskName, string $description);
    public function updateTask(int $id);

}




?>