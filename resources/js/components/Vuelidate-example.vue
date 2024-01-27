<template>
  <div>
    <h1>Add Car</h1>
    <form @submit.prevent="addCar">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Make:</label>
          
            <input id="make" class="full form-control" v-model.lazy="$v.car.make.$model" type="text">
            <p class="error" v-if="!$v.car.make.required">this field is required</p>     
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Model:</label>
           
              <input type="text" class="form-control" required v-model="car.model">
             
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Year:</label> 
              <input type="text" class="form-control" v-model="car.mfg_year">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Mileage:</label>
              <input type="text" class="form-control" v-model="car.current_mileage">
            </div>
          </div>
        </div>
        <div class="form-group">
          <button class="btn btn-primary">Create</button>
        </div>
    </form>
  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";

    export default {
      data: function () {
        return {
          car:{
            make: '',
            model: '',
            mfg_year: '',
            current_mileage: '',
        }
      }
    },
    
    validations: {
      car: {
        make: {
          required
        }
      }
    },
    
    methods: {
      addCar(){
        console.log("adding car");
        var app = this;
        let uri = '/api/car/create';
        this.axios.post(uri, this.car)
          .then(function (resp) {
             app.$router.push({path: "/cars"});
             alert("car added");
           })
           .catch(function (resp) {
              if (resp.response) {
                alert("Could not add car");
                console.log(resp.response.data);
                console.log(resp.response.status);
                console.log(resp.response.header);
              }
            });
      } 
    }
  }
</script>
