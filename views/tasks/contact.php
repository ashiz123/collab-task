

<div class="container mt-5">
    <h2 class="mb-4">Contact Us</h2>

   <?php if (isset($_SESSION['response'] ) &&  
   is_array($_SESSION['response']) && 
   in_array($_SESSION['response'] ['status'], ['success', 'error'])):
      $response = $_SESSION['response']
      ?>
    <div class="alert alert-<?= $response['status'] === 'success' ? 'success' : 'danger' ?>" role="alert">
        <strong><?= htmlspecialchars($response['status']) ?></strong> <?= htmlspecialchars($response['message']) ?>
    </div>
   
    <?php endif; ?>
  


    <form action = "contact" method = "POST">
    <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" required />
    
    <?php if (isset($_SESSION['response']['data']['name'])): ?>

        <div class="text-danger ml-3">
            <?= htmlspecialchars($_SESSION['response']['data']['name']) ?>
        </div>
    <?php endif; ?>
    
</div>

      <div class="row mb-3">
      <div class=" col-md-6">
        <label for="email" class="form-label">Phone number</label>
        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your phone number"  required/>

        <?php if(isset($_SESSION['response']['data']['phone'])): ?>
          <div class="text-danger ml-3">
            <?= htmlspecialchars($_SESSION['response']['data']['phone']) ?>
        </div>

        <?php endif; ?>
      </div>

      
     
      
      
      <div class="col-md-6">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required />
      </div></div>

      
      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea name="message" class="form-control" id="message" rows="5" placeholder="Your message" required></textarea>

        <?php if (isset($_SESSION['response']['data']['message'])): ?>

        <div class="text-danger ml-3">
            <?= htmlspecialchars($_SESSION['response']['data']['message']) ?>
        </div>

        
        <?php endif; ?>
      </div>
      <button type="submit" class="btn btn-primary rounded-pill ">Submit</button>
    </form>
  </div>