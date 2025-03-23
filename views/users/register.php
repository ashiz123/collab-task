<div class="container">
    <div class="register-container">
      <h2>Create Account</h2>
      <form action = "register-user" method="POST">
        <!-- First Name -->
        <div class="form-group">
          <label for="firstName">First Name</label>
          <input type="text" class="form-control" name="firstname" id="firstName" placeholder="Enter your first name" required>
        </div>

        <!-- Last Name -->
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Enter your last name" required>
        </div>

        <!-- Email -->
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <!-- Password -->
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-custom">Register</button>
      </form>
    </div>
  </div>