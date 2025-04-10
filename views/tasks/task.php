



<div class="container my-5">
<?php if(isset($task)) : ?>
  <div class="card shadow-sm">
    <div class="card-body">
      <h3 class="card-title"><?= htmlspecialchars($task['task']); ?></h3>
      <p><strong>Description:</strong> <?= htmlspecialchars($task['description']); ?></p>


      <?php if (isset($assignUsers) && count($assignUsers)) : ?>

<table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Priority </th>
            </tr>
        </thead>
        <tbody id="assigned-users-list">
           <?php foreach($assignUsers as $assignUser) :   ?>
            <tr>
                <td><?= htmlspecialchars($assignUser->firstname)  ?>   <?= htmlspecialchars($assignUser->lastname)  ?></td>
                <td><?= htmlspecialchars($assignUser->pivot->role_name) ?></td>
                <td><?= htmlspecialchars($assignUser->pivot->deadline ?? 'No deadline')  ?></td>
                <td><?= htmlspecialchars($assignUser->pivot->status) ?></td>
                <td><?= htmlspecialchars($assignUser->pivot->priority) ?></td>
            </tr>
           <?php endforeach ?>


        </tbody>
    </table>




        <?php endif ?>

      <h3>Assigned Users</h3>
   

      <form action="/assign-task/<?= $task->id; ?>" method="POST">
        <!-- @csrf -->

        <!-- Priority (still global) -->
        <div class="mb-3">
          <label class="form-label">Task Priority</label>
          <select class="form-select" name="priority">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high" selected>High</option>
          </select>
        </div>

        <!-- Assigned Users -->
        <h5 class="mt-4">Assign Users</h5>
        <div id="user-assignments">
          <!-- Dynamic user rows go here -->
        </div>

        <!-- Add user -->
        <div class="mb-3">
          <button type="button" class="btn btn-outline-secondary" onclick="addUser()">+ Add User</button>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Save Task</button>
      </form>
    </div>
  </div>
</div>

<script>
  let userIndex = 0;

  function addUser() {
    const users = <?php echo json_encode($allUsers); ?>;

    const userOptions = users.map(u => `<option value="${u.id}">${u.firstname} ${u.lastname}</option>`).join('');

    const row = `
      <div class="row g-3 align-items-end mb-2 user-row" id="user-row-${userIndex}">
        <div class="col-md-3">
          <label class="form-label">User</label>
          <select class="form-select" name="users[${userIndex}][id]">
            <option value="">-- Select User --</option>
            ${userOptions}
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Role</label>
          <input type="text" class="form-control" name="users[${userIndex}][role_name]" placeholder="e.g. UI, Logo">
        </div>
        <div class="col-md-4">
          <label class="form-label">Deadline</label>
          <input type="date" class="form-control" name="users[${userIndex}][deadline]">
        </div>
        <div class="col-md-2">
          <button type="button" class="btn btn-danger w-100" onclick="removeUser(${userIndex})">Remove</button>
        </div>
      </div>
    `;

    document.getElementById('user-assignments').insertAdjacentHTML('beforeend', row);
    userIndex++;
  }

  function removeUser(index) {
    const row = document.getElementById(`user-row-${index}`);
    if (row) row.remove();
  }
</script>
<?php endif ?>