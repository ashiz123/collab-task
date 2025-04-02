<?php $pageTitle = isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Task Manager'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <!-- Bootstrap CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

<!-- header -->
   <?php require_once __DIR__ . '/header..php'; ?>
   <?php require_once __DIR__ . '/navigation.php' ?> 

   <!-- content -->
   <div class="container">
    <?php
        if(isset($contentFile) && file_exists($contentFile)){
            require_once($contentFile);
        }else {
            echo '<p> Error : page cannot found,Likely issue with path </p>';
        }
    ?>  
   </div>
 <!-- footer -->
   <?php require_once __DIR__ . '/footer.php' ?>
   <!-- jQuery (Required for Bootstrap 4) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js (Required for Bootstrap 4) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Bootstrap 4.6.2 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
