
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

