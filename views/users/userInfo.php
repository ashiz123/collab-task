<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info</title>
</head>
<body>
    <h1>User Information</h1>
    <p>First Name: <?php echo htmlspecialchars($user->getFirstName()); ?></p>
    <p>Last Name: <?php echo htmlspecialchars($user->getLastName()); ?></p>
</body>
</html>