<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use models\Skill;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Your Skills</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Select Skills</h4>
                    </div>
                    <div class="card-body">
                        <form action="/skills/select" method="POST">
                            <div class="mb-4">
                                <div class="row row-cols-1 row-cols-md-3 g-3">
                                    <?php
                                    $skills = Skill::all();
                                    foreach ($skills as $skill):
                                    ?>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="selected_skills[]" 
                                                       value="<?php echo $skill->id; ?>" 
                                                       id="skill_<?php echo $skill->id; ?>">
                                                <label class="form-check-label" for="skill_<?php echo $skill->id; ?>">
                                                    <?php echo htmlspecialchars($skill->name); ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>