

<?php
$users = $userRolesData['users'] ?? [];
$roles = $userRolesData['roles'] ?? [];


?>

<!-- Filter form -->
<form method="get" class="mb-3">
  <div class="row g-2 align-items-center border-bottom pb-2">
    <div class="col-6 col-md-4">
      <label for="userSelect" class="form-label">Filter by User</label>
      <select id="userSelect" name="user_id" class="form-select">
        <option value="" selected>All Users</option>
        <?php foreach ($users as $user): ?>
          <option value="<?= htmlspecialchars($user->id) ?>">
            <?= htmlspecialchars($user->full_name) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-6 col-md-4">
      <label for="roleSelect" class="form-label">Filter by Role</label>
      <select id="roleSelect" name="role_id" class="form-select">
        <option value="" selected>All Roles</option>
        <?php foreach ($roles as $role): ?>
          <option value="<?= htmlspecialchars($role->id) ?>">
            <?= htmlspecialchars($role->title) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-12 col-md-4 d-flex align-items-end">
      <button type="submit" class="btn btn-outline-primary w-100">Apply Filters</button>
    </div>
  </div>
</form>

<!-- User role table -->
<table class="table table-hover table-striped mb-0">
  <colgroup>
    <col style="width: 5%;">
    <col style="width: 20%;">
    <col style="width: 20%;">
    <col style="width: 35%;">
    <col style="width: 20%;">
  </colgroup>
  <thead class="table-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">User name</th>
      <th scope="col">Role name</th>
      <th scope = "col">Permissions</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php if (count($users) === 0): ?>
      <tr>
        <td colspan="4" class="text-center py-4 text-muted">No users found.</td>
      </tr>
    <?php else: ?>
      <?php 
        $sn = 1;
        foreach ($users as $user): 
          $roleTitle = $user->roles->first()?->title ?? 'undefined';
          $roleId = $user->roles->first()?->id ?? '';
      ?>
        <tr>
          <td><?= $sn++ ?></td>
          <td><strong><?= htmlspecialchars($user->full_name) ?></strong></td>
          <td><?= htmlspecialchars(ucfirst(strtolower($roleTitle))) ?></td>
           <td>
            <?php 
              $permissionTitles = $user->roles->first()?->permissions->pluck('title')->toArray() ?? [];
              if (!empty($permissionTitles)) {
                echo htmlspecialchars(ucfirst(strtolower(implode(', ', $permissionTitles))));
            } else {
                echo "No permissions set";
            }
            ?>
           </td>
          <td>
            <a class="btn btn-primary" href="#">Edit</a>
            <?php if ($roleId): ?>
              <a class="btn btn-danger" href="/admin/role/delete/<?= htmlspecialchars($roleId) ?>">Delete</a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>