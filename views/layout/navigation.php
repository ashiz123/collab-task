<?php
use models\User;
if(isset($_SESSION['auth_user'])){
  $user = User::find($_SESSION['auth_user']['id']);
  }
?>


<?php

use utils\Logger;

  $current_page = basename($_SERVER['PHP_SELF']); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
  <a class="navbar-brand" href="#">Create Todo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo ($current_page === 'home')? 'active' : ''; ?>">
        <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item  <?php echo($current_page === 'create-task') ? 'active' : ''; ?> ">
        <a class="nav-link" href="/create-task">Create Task</a>
      </li>
      <li class="nav-item <?php echo($current_page === 'tasks') ? 'active' : '';  ?>">
        <a class="nav-link" href="/tasks">Created</a>
      </li>
      <li class="nav-item <?php echo($current_page === 'view-assign-task') ? 'active' : '';  ?>">
        <a class="nav-link" href="/view-assign-task">Assigned </a>
      </li>
      <li class="nav-item  <?php echo($current_page === 'contact') ? 'active' : '';  ?>">
        <a class="nav-link" href="/contact">Contact</a>
      </li>
      
</div>
     

      <div ml-auto>
        <?php if(isset($_SESSION['auth_user'])): Logger::info(json_encode($_SESSION['auth_user']))?>
        <!-- <a class="btn btn-secondary" href="./logout-user"> Logout</a> -->
        <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
  <?php if (isset($_SESSION['auth_user'])): ?>
      
    <?= htmlspecialchars($_SESSION['auth_user']['firstname']) ?>
    <?= htmlspecialchars($_SESSION['auth_user']['lastname']) ?>
  <?php endif; ?>
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="/profile">My Profile</a>
    <a class="dropdown-item" href="/notifications">
      My Notifications
      <span class="badge bg-danger ms-2 text-white" id='unread-count'><?= $user->unreadNotificationCount(); ?></span> 
    </a>
    <a class="dropdown-item" href="/logout-user">Logout</a>
  </div>
</div>
        <?php else: ?>
        <a class="btn btn-primary" href="./login-user"> Login</a>
        <?php endif ?>
       </div>
  </div>
</nav> 