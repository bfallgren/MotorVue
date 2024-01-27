<template>
  <div id='motor-info'>
    <h1>Add Task</h1>
    <form @submit.prevent="addTask">
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label>Description:</label>
            <textarea class="form-control" required maxlength="255" v-model="task.description"></textarea>   
          </div>
        </div>       
        <div class="col-md-3">
          <div class="form-group">
            <label>Mileage Int.:</label>     
              <input type="number" class="form-control" v-model="task.mileage_interval">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Month Int.:</label> 
            <input type="number" class="form-control" v-model="task.month_interval">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Last Completed Mileage:</label>
            <input type="number" class="form-control" v-model="task.last_completed_miles">
          </div>
        </div>
        
        <div class="col-md-3">
          <div class="form-group">
            <label>Last Completed Date:</label>
            <input type="date" class="form-control" v-model="task.last_completed_date">   
          </div>
        </div>      

		 <input type="hidden" v-model="task.motor_id">   
        
        
        <div class="md-col-12">
          <div class="form-group">
            <button class="btn btn-primary">Create</button>
          </div>
        </div>
      </div>    
    </form>
  </div>
</template>

<script>

  export default {
	data: function () {
      return {
        task:{}
      }
    },
    
    methods: {
      addTask(){
        console.log("adding task - motor id: ", this.$route.params.id);
        this.task.motor_id = this.$route.params.id;
        let motorid = this.task.motor_id;
		    let uri = `/api/task/create`;
        this.axios.post(uri, this.task)
           .then(function (resp) {
              Swal.fire({              
                text: "Task Inserted",
                icon: 'success',
                timer: 6000
              }).then(function() {
                // Redirect the user
                let url = `/tasks/index/` + motorid; 
                window.location.href = url; 
               });
                
           })
           .catch(function (resp) {
              if (resp.response) {
                Swal.fire({              
               
                  title: "Error",
                  text: resp.response.data.message,
                  icon: 'error',
                  timer: 6000,
                });
                console.log("response msg = "+resp.response.data.message);
                console.log("response status = "+resp.response.status);
                console.log("response status text = "+resp.response.statusText);       
              }
            });
      }   
    }
  }
</script>
