


    


<?php if (!empty($tasks)): ?>
<h1 class="mb-4">Task List</h1>
    <ul class="list-group">
      <!-- Task 1 -->
       <?php foreach($tasks as $task): ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <h5 class="mb-1"><?= htmlspecialchars($task['task']); ?></h5>
          <p class="mb-1 text-muted">Create a responsive design for the landing page.</p>
          <span class="badge bg-primary">In Progress</span>
          <span class="badge bg-warning">High Priority</span>
        </div>
        <form action="/update-status/<?php echo $task->id; ?>" method="POST" class="m-0">
            <button type="submit" class="btn btn-sm <?php echo $task->status === 'completed' ? 'btn-success' : 'btn-secondary'; ?>">
                <?php echo $task->status === 'pending' ? 'Complete' : 'Undo'; ?>
            </button>
        </form>
      </li>

    <?php endforeach;   else: ?>
        <p>No tasks found.</p>

      <?php endif; ?>