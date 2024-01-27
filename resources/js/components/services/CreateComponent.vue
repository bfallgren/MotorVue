<template>
  <div id='motor-info'>
    <h1>Add Service</h1>
    <form @submit.prevent="addService">
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label>Service Date:</label>
            <input type="date" class="form-control" v-model="service.service_date">   
          </div>
        </div>       
        <div class="col-md-3">
          <div class="form-group">
            <label>Location:</label>     
              <input type="text" class="form-control" maxlength="50" v-model="service.location">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Cost:</label> 
            <input type="number" class="form-control" step="0.01" v-model="service.cost">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Description:</label>
            <textarea class="form-control" maxlength="255" v-model="service.description"></textarea>
          </div>
        </div>
        
        <div class="col-md-3">
          <div class="form-group">
            <label>Mileage:</label>
            <input type="number" class="form-control" v-model="service.mileage">   
          </div>
        </div>      

		 <input type="hidden" v-model="service.motor_id">   
        
        
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
        service:{}
      }
    },
    
    methods: {
      addService(){
        console.log("adding service - motor id: ", this.$route.params.id);
        this.service.motor_id = this.$route.params.id;
        let motorid = this.service.motor_id;
		    let uri = `/api/service/create`;
        this.axios.post(uri, this.service)
           .then(function (resp) {
              Swal.fire({              
                text: "Service Inserted",
                icon: 'success',
                timer: 6000
              }).then(function() {
                // Redirect the user
                let url = `/services/index/` + motorid; 
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
