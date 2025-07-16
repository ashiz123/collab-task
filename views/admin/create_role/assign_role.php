


        <form method="post" action = "/admin/assign-role">
      
          <div class="mb-3">
            <label for="userSelect" class="form-label">Select User</label>
            <select class="form-select" id="userSelect" name ="user_id">
              <option selected disabled>Choose user...</option>
              <?php foreach ($users as $user) { 
                echo '<option value="' . $user['id'] . '">' . $user['firstname']. " ". $user['lastname']. '</option>';
               } ?>
             
            </select>
          </div>

          <div class="mb-3">
            <label for="roleSelect" class="form-label">Select Role</label>
            <select class="form-select" id="roleSelect" name="role_id">
              <option selected disabled>Choose role...</option>
              <?php foreach ($roles as $role) {
                 echo '<option value="'. $role['id'] . '">' . $role['title'] . '</option>';
              }?>
             </select>
          </div>

          <button type="submit" class="btn btn-success">Assign Role</button>
        </form>


  