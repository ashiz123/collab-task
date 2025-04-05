

<?php if(isset($_SESSION['verify_otp']) && $_SESSION['verify_otp']['status'] === 'error'): ?>
    <div class="alert alert-danger" role="alert">
     <p class="text-center pt-3"><?= htmlspecialchars($_SESSION['verify_otp']['message']) ?></p> 
  </div>  

  <?php elseif(isset($_SESSION['verify_otp']) && $_SESSION['verify_otp']['status'] === 'success'): ?>
    <div class="alert alert-success" role="alert">
     <p class="text-center pt-3"><?= htmlspecialchars($_SESSION['verify_otp']['message']) ?></p> 
  </div>


<?php unset($_SESSION['verify_otp']); endif ?>



<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>OTP Verification</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="verify-otp">
                        <div class="mb-3">
                            <label for="otp" class="form-label">Enter OTP:</label>
                            <input type="text" class="form-control" id="otp" name="otp" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Verify OTP</button>
                    </form>
                    
                    <?php if (isset($errorMessage)): ?>
                        <div class="alert alert-danger mt-3"><?php echo $errorMessage; ?></div>
                    <?php endif; ?>

                </div>
            </div>
            <div class="text-center mt-3">
                <p>If you did not receive the OTP, <a href="./resend-otp">click here to resend OTP</a>.</p>
            </div>
        </div>
    </div>
</div>



