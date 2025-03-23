<div class="container">
    <div class="register-container">
      <h2>Login User</h2>
      <form action = "login-user" method="POST">
       
      <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>

       
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
        </div>

        <button type="submit" class="btn btn-custom">Login</button>
        <p class="mt-3">Don't have an account? <a href="/register-user" class="text-primary">Register here</a></p>
      </form>
    </div>
  </div>