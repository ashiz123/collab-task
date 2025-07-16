<!-- filter form -->
         <div class="row g-2 align-items-center mb-3 border-bottom pb-2">
          <div class="col-6 col-md-4">
            <label for="userSelect" class="form-label">Filter by User</label>
            <select id="userSelect" class="form-select">
              <option selected>All Users</option>
              <option value="1">Alice</option>
              <option value="2">Bob</option>
              <option value="3">Charlie</option>
            </select>
          </div>
          <div class="col-6 col-md-4">
            <label for="roleSelect" class="form-label">Filter by Role</label>
            <select id="roleSelect" class="form-select">
              <option selected>All Roles</option>
              <option value="admin">Admin</option>
              <option value="editor">Editor</option>
              <option value="viewer">Viewer</option>
            </select>
          </div>
          <div class="col-12 col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-outline-primary w-100">Apply Filters</button>
          </div>
        </div>

          <!-- user role table -->
        <table class="table table-hover table-striped mb-0">
                    <colgroup>
                        <col style="width: 10%;">
                        <col style="width: 30%;">
                        <col style="width: 40%;">
                        <col style="width: 20%;">
                    </colgroup>
                    <thead class="table-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User name</th>
                            <th scope="col">Role name</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($roles) === 0): ?>
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">No roles found.</td>
                            </tr>
                        <?php else: ?>
                            <?php 
                                $sn = 1;
                                foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $sn++ ?></td>
                                    <td><strong><?= htmlspecialchars($user->full_name) ?></strong></td>
                                   <td><?= htmlspecialchars(ucfirst(strtolower($user->roles->first()?->title ?? 'undefined'))) ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="">Edit</a>
                                         <a class="btn btn-danger" href="/admin/role/delete/<?= htmlspecialchars($role['id']) ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>