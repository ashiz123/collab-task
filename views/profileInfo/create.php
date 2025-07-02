<link rel="stylesheet" href="/public/css/create-profile.css">
    
    <div class="container">
        <div class="profile-container">
            <h2 class="text-center mb-4">Complete Your Profile</h2>
            <form action="save-profile-info" method="POST" enctype="multipart/form-data">
                <!-- Avatar Upload -->
                 <div>
                 <div class="mb-4">
                    <label for="avatar" class="form-label">Profile Picture</label>
                    <div class="avatar-upload-container">
                        <img id="avatar-preview" src="https://via.placeholder.com/150" alt="Profile Picture Preview">
                        <i class="bi bi-cloud-upload"></i>
                        <span>Click to upload</span>
                        <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                    </div>
                    <div class="form-text text-center">Upload a profile picture (optional)</div>
                </div>
                 </div>
               
                <script>
                    document.getElementById('avatar').onchange = function(e) {
                        const preview = document.getElementById('avatar-preview');
                        const file = e.target.files[0];
                        if(file) {
                            preview.style.display = 'block';
                            preview.src = URL.createObjectURL(file);
                        }
                    };
                </script>

                <!-- Bio -->
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Tell us about yourself"></textarea>
                </div>

                <!-- Date of Birth -->
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                </div>

                <!-- Contact Information -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number">
                    </div>
                    <div class="col-md-6">
                        <label for="website" class="form-label">Website</label>
                        <input type="url" class="form-control" id="website" name="website" placeholder="https://yourwebsite.com">
                    </div>
                </div>

                <!-- Address Information -->
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter your street address">
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city">
                    </div>
                    <div class="col-md-4">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="Enter your country">
                    </div>
                    <div class="col-md-4">
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Enter postal code">
                    </div>
                </div>

                <!-- Social Media Links -->
                <div class="mb-3">
                    <label for="social_media_links" class="form-label">Social Media Links</label>
                    <input type="text" class="form-control" id="social_media_links" name="social_media_links" placeholder="Enter your social media profile URLs">
                    <div class="form-text">Separate multiple links with commas</div>
                </div>

                <!-- Skills Selection -->
                <div class="mb-4">
                    <label for="skills" class="form-label">Skills</label>
                    <select class="form-select" id="skills" name="skills[]" multiple>
                        <?php foreach($predefinedSkills as $skill): ?>
                            <option value="<?= htmlspecialchars($skill->id) ?>">
                                <?= htmlspecialchars($skill->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-text">Hold Ctrl/Cmd to select multiple skills</div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Save Profile</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('skills').onchange = function(e) {
            const selectedSkills = Array.from(e.target.selectedOptions).map(option => option.value);
            console.log(selectedSkills);

            const skillIds = selectedSkills.map(skillId => parseInt(skillId));
            console.log(skillIds);

            const skillIdsString = skillIds.join(',');
            console.log(skillIdsString);    
            
            document.getElementById('skills').value = skillIdsString;

            console.log(document.getElementById('skills').value);           
        };
    </script>

   