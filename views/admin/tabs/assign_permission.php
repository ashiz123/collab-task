<?php
  $roles = $assignPermissionData['roles'] ?? [];
  $permissions = $assignPermissionData['permissions'] ?? [];
  $message = $assignPermissionData['message'] ?? '';
  $errors = $assignPermissionData['errors'] ?? [];
?>

<!-- alert message -->
<?php include __DIR__ . '/../../layout/success_alert.php' ?>


<div class="card-body">

        <form method="post" action = "/admin/assign-permission">

         <div class="mb-3">
            <label for="roleSelect" class="form-label">Select Role</label>
            <select class="form-select" id="roleSelect" name="role_id">
              <option selected disabled>Choose role</option>
              <?php foreach ($roles as $role) {
                 echo '<option value="'. $role['id'] . '">' . $role['title'] . '</option>';
              }?>
             </select>
          </div>
      
          <div class="mb-3">
            <label for="userSelect" class="form-label">Select Permission</label>
            <select class="form-select" id="userSelect" name ="permission_id">
              <option selected disabled>Choose permission</option>
              <?php foreach ($permissions as $permission) { 
                   echo '<option value="' . $permission['id'] . '">' . $permission['title'] . '</option>';
               } ?>
             
            </select>
          </div>

         

          <button type="submit" class="btn btn-success">Assign Permission</button>
        </form>
</div>


  