<?php  $current_page = basename($_SERVER['PHP_SELF']); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
  <a class="navbar-brand" href="#">Create Todo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo ($current_page === 'home')? 'active' : ''; ?>">
        <a class="nav-link" href="./home">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item  <?php echo($current_page === 'create-task') ? 'active' : ''; ?> ">
        <a class="nav-link" href="./create-task">Create Task</a>
      </li>
      <li class="nav-item <?php echo($current_page === 'tasks') ? 'active' : '';  ?>">
        <a class="nav-link" href="./tasks">Tasks</a>
      </li>
      <li class="nav-item  <?php echo($current_page === 'contact') ? 'active' : '';  ?>">
        <a class="nav-link" href="./contact">Contact</a>
      </li>
     

      <div ml-auto>
        <?php 
     

       if(isset($_SESSION['auth_user'])){
        echo '<a class="btn btn-secondary" href="./logout-user"> Logout</a>';
        }else
        {
          echo '<a class="btn btn-primary" href="./login-user"> Login</a>';
        }

        ?>
     
      </div>
  </div>
  </div>
</nav> 