


    


<?php if (!empty($tasks)): ?>
<h1 class="mb-4">Task List</h1>
    <ul class="list-group">
      <!-- Task 1 -->
       <?php foreach($tasks as $task): ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <?php if(isset($task)  && $task['status'] === 'completed') : ?>
            <h5 class="mb-1 text-middle-truncate"><?= htmlspecialchars($task['task']); ?></h5>
            <p class="text-middle-truncate">
            <?= htmlspecialchars($task['description']); ?>
            </p>
            <?php else: ?>
            <h5 class="mb-1"><?= htmlspecialchars($task['task']); ?></h5>
            <p class="mb-1 text-muted"><?= htmlspecialchars($task['description'])  ?></p>
          <?php endif ?>

          <?php if(isset($task)  && $task['status'] !== 'completed') : ?>
          <span class="badge bg-primary">In Progress</span>
          <?php endif ?>
          <span class="badge bg-warning">High Priority</span>
        </div>
        <div class="m-0">
        <form action="/task/update-status/<?php echo $task->id; ?>" method="POST" >
            <button type="submit" class="btn btn-sm <?php echo $task->status === 'completed' ? 'btn-success' : 'btn-secondary'; ?>">
                <?php echo $task->status === 'pending' ? 'Complete' : 'Undo'; ?>
            </button>
            
        </form>
        <!-- <form action = "/task/ ?>" class="mt-2" method="GET">
           <button type="submit" class="btn btn-sm btn-primary" >
                View Task
            </button>
        </form> -->
        <a href="/task/<?php echo $task->id ?>" class="btn btn-sm btn-primary mt-2">View Task</a>
        </div>
       
      </li>

    <?php endforeach;   else: ?>
        <p>No tasks found.</p>

      <?php endif; ?>