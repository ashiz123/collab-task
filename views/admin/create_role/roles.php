
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
                            <th scope="col">Role Name</th>
                            <th scope="col">Description</th>
                             <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($roles) === 0): ?>
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">No roles found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($roles as $role): ?>
                                <tr>
                                    <td><?= $role['id'] ?></td>
                                    <td><strong><?= htmlspecialchars($role['title']) ?></strong></td>
                                    <td><?= htmlspecialchars($role['description']) ?: '<em class="text-muted">No description</em>' ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="">Edit</a>
                                         <a class="btn btn-danger" href="/admin/role/delete/<?= htmlspecialchars($role['id']) ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

  