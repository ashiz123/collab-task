
<!-- admin master page -->

<?php
use utils\Flash;
?>

<div class="container py-4">
    <h2 class="mb-4">Admin Dashboard</h2>

    <!-- Tabs header  -->
     
    <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link <?= isActiveTab('create-role') ?>" id="create-role-tab" data-bs-toggle="tab" data-bs-target="#create-role" type="button" role="tab">
          Create Role
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link <?= isActiveTab('roles-list') ?>" id="roles-list-tab" data-bs-toggle="tab" data-bs-target="#roles-list" type="button" role="tab">
          Roles List
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link <?= isActiveTab('assign-role') ?>" id="assign-role-tab" data-bs-toggle="tab" data-bs-target="#assign-role" type="button" role="tab">
          Assign Roles
        </button> 
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link <?= isActiveTab('user-roles') ?>" id="user-role-tab" data-bs-toggle="tab" data-bs-target="#user-roles" type="button" role="tab">
          User Roles
        </button> 
      </li>
    </ul>


    <!-- tab content -->
    <div class="tab-content mt-3" id="dashboardTabsContent">
       
      <div class="tab-pane fade <?= isActiveTabPanel('create-role') ?>" id="create-role" role="tabpanel">
          <?php if (Flash::has('create_role')): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= Flash::get('create_role') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        <?php include __DIR__ . '/add_role.php'; ?>
      </div>

      <div class="tab-pane fade <?= isActiveTabPanel('roles-list') ?>" id="roles-list" role="tabpanel">
        <?php include __DIR__ . '/roles.php'; ?>
      </div>

      <div class="tab-pane fade <?= isActiveTabPanel('assign-role') ?>" id="assign-role" role="tabpanel">
        <?php if (Flash::has('assign_role_message')): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= Flash::get('assign_role_message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        <?php include __DIR__ . '/assign_role.php'; ?>
      </div>
    </div>

     <div class="tab-pane fade <?= isActiveTabPanel('user-roles') ?>" id="user-roles" role="tabpanel">
        <?php include __DIR__ . '/user_role.php'; ?>
      </div>

    
   
    </div>


  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  ></script>




  