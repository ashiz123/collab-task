

  <!-- <div class="">
  <h2>Add Task</h2>
    <form action="create-task" method="POST">
        <label for="task">Task Description:</label>
        <input type="text" id="task" name="task" required>

        <button type="submit">Add Task</button>
    </form>
  </div> -->

  <div class="container">
    <div class="task-container">
      <h2>Create New Task</h2>
      <form action="create-task" method="POST">
        <!-- Task Name -->
        <div class="form-group">
          <label for="taskName">Task Name</label>
          <input name = "task" type="text" class="form-control" id="taskName" placeholder="Enter task name" required>
        </div>

        <!-- Description -->
        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter task description" required></textarea>
        </div>

        <!-- Add Task Button -->
        <button type="submit" class="btn btn-custom">Add Task</button>
      </form>
    </div>
  </div>