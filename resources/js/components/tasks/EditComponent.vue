<template>
  <div>
    <h3>Edit Tasks: {{task.model}}</h3>
    <form @submit.prevent="updateTask"> 
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
      </div>
      <div class="md-col-12"> 
        <div class="form-group">
          <button class="btn btn-success">Update</button>
          <router-link :to="{name: 'tasks', params: { id: this.task.motor_id }}" class="btn btn-warning">Cancel</router-link>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
    export default {

      data() {
        return {
          task: {}
        }
      },
      created() {
        console.log("edit-started");
        let uri = `/api/task/edit/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.task = response.data;
        });
      },
      methods: {
        updateTask() {
          console.log("edit-completed");
          let uri = `/api/task/update/${this.$route.params.id}`;
          this.axios.post(uri, this.task).then((response) => {
            this.$router.push({path: `/tasks/index/${this.task.motor_id}`});
            
          });
        }
      }
    }
</script>
