

 <div class="container my-5" style="max-width: 600px;">


 <?php if(isset($message)) : ?>
    <div class="alert alert-success" role="alert">
        <strong><?= htmlspecialchars($message) ?></strong> 
    </div>
    <?php endif ?>


    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Create New Role</h5>
        </div>
        <div class="card-body">
            <form method="POST" action = '/admin/roles'>
  <!-- Role Name -->
  <div class="mb-4">
    <label for="role_name" class="form-label fw-semibold">
      Role Name <span class="text-danger">*</span>
    </label>
    <input 
      type="text" 
      class="form-control" 
      id="role_name" 
      name="role_name" 
      placeholder="e.g. Admin, Editor, Viewer" 
      aria-describedby="roleNameHelp"
      
    >
    <div id="roleNameHelp" class="form-text">Enter a descriptive name for the role.</div>
     <?php if (isset($errors['title'])) { ?>
    <div class="text-danger small">
        <?= htmlspecialchars($errors['title']) ?>
    </div>
<?php } ?>
  </div>

  <!-- Role Description -->
  <div class="mb-4">
    <label for="role_description" class="form-label fw-semibold">
      Role Description <span class="text-danger">*</span>
    </label>
    <textarea 
      class="form-control" 
      id="role_description" 
      name="role_description" 
      placeholder="Describe the responsibilities and scope of this role..." 
      rows="4" 
      
      aria-describedby="roleDescHelp"
    ></textarea>
    <div id="roleDescHelp" class="form-text">
      Be specific so team members understand the role’s purpose.
    </div>
     <?php if (isset($errors['description'])) { ?>
    <div class="text-danger small">
        <?= htmlspecialchars($errors['description']) ?>
    </div>
<?php } ?>
  </div>

  <!-- Buttons -->
  <div class="d-flex justify-content-between align-items-center">
    <button type="submit" class="btn btn-success">
      <i class="bi bi-plus-circle me-1"></i> Create Role
    </button>
   
  </div>
</form>
        </div>
    </div>
</div>

<div class="container my-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-shield-lock-fill me-2 text-primary"></i>All Roles</h5>
            <span class="badge bg-secondary"><?= count($roles) ?> total</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
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
                                         <a class="btn btn-danger" href="">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




