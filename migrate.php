<?php

use config\Database;


// Path to your migrations folder
$migrationsPath = __DIR__ . '/migrations';


// Check if the folder exists
if (!is_dir($migrationsPath)) {
    echo "Migrations folder not found.\n";
    exit;
}

// Load and run all PHP migration files from the folder
$files = glob("$migrationsPath/*.php");

if (empty($files)) {
    echo "No migrations found.\n";
    exit;
}

foreach ($files as $file) {
    echo "Running migration: " . basename($file) . "\n";
    require $file;
}

echo "All migrations executed successfully!\n";