
    
     <link rel="stylesheet" href="/public/css/profile.css">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="container">
            <div class="row align-items-center">
                <?php if($profileInfo): ?>
                <div class="col-md-3 text-center">
                    <img src= <?= htmlspecialchars('/public/uploads/' . $profileInfo->avatar) ?> alt="Profile Picture" class="profile-img mb-3">
                </div>
                <?php endif; ?>
                <div class="col-md-9">
                    <h1 class="display-5"><?php echo $user->firstname . ' ' . $user->lastname?></h1>
                    <p class="lead">Software Developer</p>
                    <div class="d-flex gap-2">
                        <?php if($profileInfo): ?>
                        <span class="badge bg-light text-dark">
                            <i class="bi bi-geo-alt"></i><?= htmlspecialchars($profileInfo->address), htmlspecialchars($profileInfo->city), htmlspecialchars($profileInfo->country) ?>
                        </span> 
                        <?php endif; ?>
                        <span class="badge bg-light text-dark">
                            <i class="bi bi-envelope"></i> <?= htmlspecialchars($user->email) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row">
            <!-- Left Column - Stats -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Statistics</h5>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="card stat-card bg-light">
                                    <div class="card-body text-center">
                                        <h3 class="mb-0">42</h3>
                                        <small class="text-muted">Tasks</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card stat-card bg-light">
                                    <div class="card-body text-center">
                                        <h3 class="mb-0">15</h3>
                                        <small class="text-muted">Completed</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

             
                 
                <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Profile Progress</h5>
                       <?php if($progression): ?>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?= htmlspecialchars($progression) ?>%" aria-valuenow="<?= htmlspecialchars($progression) ?>" aria-valuemin="0" aria-valuemax="100"><?= htmlspecialchars($progression) ?>%</div>
                    </div> 
                     <?php endif ?>
                    <p class="mt-3">Complete your profile to unlock all features</p>
                </div>
            </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Skills</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-primary">PHP</span>
                            <span class="badge bg-primary">MySQL</span>
                            <span class="badge bg-primary">JavaScript</span>
                            <span class="badge bg-primary">HTML</span>
                            <span class="badge bg-primary">CSS</span>
                            <span class="badge bg-primary">Bootstrap</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Activity & Settings -->
            <div class="col-md-8">
                <!-- Activity Feed -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Recent Activity</h5>
                        <div class="activity-item">
                            <small class="text-muted">2 hours ago</small>
                            <p class="mb-0">Completed task "Implement user authentication"</p>
                        </div>
                        <div class="activity-item">
                            <small class="text-muted">5 hours ago</small>
                            <p class="mb-0">Created new task "Design database schema"</p>
                        </div>
                        <div class="activity-item">
                            <small class="text-muted">1 day ago</small>
                            <p class="mb-0">Updated profile information</p>
                        </div>
                    </div>
                </div>

                <!-- Settings -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Account Settings</h5>
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-person me-2"></i>
                                    Edit Profile
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-lock me-2"></i>
                                    Change Password
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-bell me-2"></i>
                                    Notification Settings
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-danger">
                                <div>
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Logout
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

