<template>
  <div>
    <h3>Edit Services: {{service.model}}</h3>
    <form @submit.prevent="updateService">
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
            <textarea class="form-control" maxlength="255"  v-model="service.description"></textarea>
          </div>
        </div>
        
        <div class="col-md-3">
          <div class="form-group">
            <label>Mileage:</label>
            <input type="number" class="form-control" v-model="service.mileage">   
          </div>
        </div>  
      <div class="md-col-12"> 
        <div class="form-group">
          <button class="btn btn-success">Update</button>
          <router-link :to="{name: 'services', params: { id: this.service.motor_id }}" class="btn btn-warning">Cancel</router-link>
        </div>
      </div>
    </div>
    </form>
  </div>
</template>

<script>
    export default {

      data() {
        return {
          service: {}
        }
      },
      created() {
        console.log("edit-started");
        let uri = `/api/service/edit/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.service = response.data;
        });
      },
      methods: {
        updateService() {
          console.log("edit-completed");
          let uri = `/api/service/update/${this.$route.params.id}`;
          this.axios.post(uri, this.service).then((response) => {
            this.$router.push({path: `/services/index/${this.service.motor_id}`});
            
          });
        }
      }
    }
</script>
