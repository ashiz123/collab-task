<div class="container mt-5">
    <h1 class="mb-4">Assigned Tasks</h1>
    

        <!-- To-Do List Cards -->
    <div class="row">

    <?php foreach($tasks as $task)  :  ?>
        


        <!-- Task 1 Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Task Name -->
                    <h5 class="card-title"><?= htmlspecialchars($task->task) ?></h5>
                    <!-- Priority Badge -->
                    <span class="badge <?= isset($task->pivot->priority) ? $task->getPriorityBadgeClass() : 'btn-secondary' ?>"> <?= htmlspecialchars($task->pivot->priority) ?></span>
                    <br>
            
                    
                    
                    
                    <p class="mt-3"><strong>Assigned By:</strong> <?= htmlspecialchars($task->getName()?? 'unknown creator') ?></p>
                    <p class="mt-3"><strong>Deadline:</strong> <?= htmlspecialchars($task->pivot->deadline) ?></p>
            
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input task-checkbox"  data-assign-id = "<?= $task->pivot->id ?>" <?= $task->pivot->status === "complete" ? "checked" : " "  ?>  >
                        <label class="form-check-label" for="task1" >Mark as Completed</label>
                      
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach ?>

        
        

</div>


<script>
   document.querySelectorAll('.task-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        const isChecked = this.checked ? "complete" : "pending";
        const assignId = this.dataset.assignId;
        // const card = this.closest('.card-body');
        // const statusBadge = card.querySelector('.badge .bg-success');

        const formData = new URLSearchParams();
        formData.append('status', isChecked);

        fetch(`assign-task/update-status/${assignId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: formData.toString()
        })
        .then(response => response.json()) // 👈 change from .json() to .text()
        .then(data => {
            
            if(data.success){
               alert(`Status updated successfully to ${data.status}`);
            }
        })

        .catch(error => {
            console.error('Error:', error);
        });
    });
});
</script>