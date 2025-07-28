<?php
  $activeTab = $tabDataService->getActiveTab();
?>


<div class="container py-4">
    <h2 class="mb-4">Admin Dashboard</h2>

    <!-- Tabs header  -->
     
   <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="?tab=create-role" class="nav-link <?= $activeTab === 'create-role' ? 'active' : '' ?>">Create Role</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="?tab=create-permission" class="nav-link <?= $activeTab === 'create-permission' ? 'active' : '' ?>">Create Permission</a>
    </li>
   
    <li class="nav-item" role="presentation">
        <a href="?tab=assign-role" class="nav-link <?= $activeTab === 'assign-role' ? 'active' : '' ?>">Assign Role</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="?tab=assign-permission" class="nav-link <?= $activeTab === 'assign-permission' ? 'active' : '' ?>">Assign Permission</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="?tab=user-roles" class="nav-link <?= $activeTab === 'user-roles' ? 'active' : '' ?>">User Roles</a>
    </li>
</ul>

<!-- internal admin routes -->
<div class="tab-content mt-3" id="dashboardTabsContent">
  <div class="tab-pane fade show active" id="<?= htmlspecialchars($activeTab) ?>" role="tabpanel">
    <?php 
    switch ($activeTab) {
      case 'create-role':
        $createRoleData = $tabDataService->getCreateRoleData();
        include __DIR__ . '/tabs/add_role.php';
        break;
        case 'create-permission':
        $createPermissonData = $tabDataService->getCreatePermissionData();
        include __DIR__ . '/tabs/add_permission.php';
        break;
    
      case 'assign-role':
        $assignRoleData = $tabDataService->getAssignRoleData();
        include __DIR__ . '/tabs/assign_role.php';
        break;
      case 'assign-permission':
        $assignPermissionData = $tabDataService->getAssignPermissionData();
        include __DIR__ . '/tabs/assign_permission.php';
        break;
      case 'user-roles':
         $userRolesData = $tabDataService->getUserRolesData();
         include __DIR__ . '/tabs/user_role.php';
        break;
      
      default:
        echo 'Tab not found.';
    }
    ?>
  </div>