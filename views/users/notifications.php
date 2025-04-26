
<h2 class="mb-4 text-primary fw-bold"><i class="bi bi-bell-fill"></i> Notifications</h2>

<?php if(isset($notifications) && !empty($notifications)): ?>
<?php foreach($notifications as $notification)  :  ?>

    <div class="card mb-3 notification-card border-info">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <!-- <h5 class="card-title mb-1 text-info"><i class="bi bi-info-circle-fill me-2"></i>Welcome to the site!</h5> -->
          <p class="card-text text-muted"><?= htmlspecialchars($notification->message) ?></p>
        </div>
        <!-- <span class="badge bg-secondary badge-status">Unread</span> -->

       <div class="form-check custom-checkbox-lg">
        <input class="form-check-input notitication-checkbox" data-notification-id = <?= $notification->id ?>  type="checkbox" id="bigCheckbox" <?= $notification->read_at ? 'checked' : ' '  ?> > 
        <label class="form-check-label" for="bigCheckbox">
          Mark as Read
        </label>
      </div>
      </div>
    </div>


<?php endforeach ?>
<?php else: ?>
    <div class="card mb-3 notification-card border-info">
    <p class="card-text text-muted">No notification</p>
    </div>
    <?php endif ?>


<script>

function formatDateForMysql(date){
  return date.toISOString().slice(0, 19).replace('T', ' ');
}


document.querySelectorAll('.notitication-checkbox').forEach(checkbox => {
  checkbox.addEventListener('change', function() {
   
    const isChecked = this.checked ? formatDateForMysql(new Date()) : null;
    const notificationId = this.dataset.notificationId;

    const formData = new URLSearchParams();
    formData.append('read', isChecked);

    fetch(`notifications/${notificationId}`, {
      method : 'POST',
      headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }, 
      body : formData.toString()
    })
    .then(response => response.json())
    .then(data => {
      if(data.success){
        console.log(data);
        alert(data.message );
      }
    })
    .catch(error => {
      console.log('Error:' , error);
    })
   

  })
})


</script>



    

    