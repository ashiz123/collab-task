<div class="container mt-5">
    <h1 class="mb-4">Assigned Tasks</h1>
    

    <?php foreach($tasks as $task)  :  ?>

    <!-- To-Do List Cards -->
    <div class="row">
        <!-- Task 1 Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Task Name -->
                    <h5 class="card-title"><?= htmlspecialchars($task->task) ?></h5>
                    <!-- Priority Badge -->
                    <span class="badge bg-danger">High Priority</span>
                    <br>
                    <!-- Status Badge -->
                    <span class="badge bg-success"><?= htmlspecialchars($task->status) ?></span>
                    
                    <!-- Deadline -->
                    <p class="mt-3"><strong>Assigned By:</strong> <?= htmlspecialchars($task->getName()?? 'unknown creator') ?></p>
                    <p class="mt-3"><strong>Deadline:</strong> <?= htmlspecialchars($task->pivot->deadline) ?></p>
                    
                    <!-- Checkbox for Task Completion -->
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="task1" checked>
                        <label class="form-check-label" for="task1">Mark as Completed</label>
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach ?>

        
        

</div>