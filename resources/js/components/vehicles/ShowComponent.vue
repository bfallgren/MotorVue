<template v-for="vehicle in vehicles" :key="vehicle.id">
  <div>
      <h1>Vehicle Detail</h1>
     
      <div class="row">
        <div class="col-md-2">
          <img :src="'/image/'+ vehicle.avatar"  width="176" height="99">
        </div>
        <div class="col-md-10"></div>
      </div>
      <br>
      <br>
      <br>
     

      <v-container class="grey lighten-5">
        <v-row>  
         
          <v-col md="1">
              <v-text-field
                label="Year"
                dense readonly filled
                v-model="vehicle.mfg_year"
               
               
              >
              </v-text-field> 
          </v-col>
           
          <v-col md="2">
              <v-text-field
                label="Make"
                dense readonly filled
                v-model="vehicle.make"
              >
              </v-text-field>
          </v-col>
          
          <v-col md="2">
              <v-text-field
                label="Model"
                dense readonly filled
                v-model="vehicle.model"
              >
              </v-text-field>
          </v-col>
          <v-spacer></v-spacer>
        </v-row>

        <v-row>  
         
          <v-col md="2">
              <v-text-field
                label="Current Mileage"
                dense readonly filled
                v-model="vehicle.current_mileage"
              >
              </v-text-field> 
          </v-col>
           
          <v-col md="2">
              <v-text-field
                label="VIN"
                dense readonly filled
                v-model="vehicle.vid"
              >
              </v-text-field>
          </v-col>
          
          <v-col md="2">
              <v-text-field
                label="License Tag"
                dense readonly filled
               v-model="vehicle.license_tag"
              >
              </v-text-field>
          </v-col>
          <v-col md="2">
              <v-text-field
                label="Ins. Provider"
                dense readonly filled
                v-model="vehicle.insurance_provider"
              >
              </v-text-field>
          </v-col>
          <v-col md="2">
              <v-text-field
                label="Ins. Policy"
                dense readonly filled
                v-model="vehicle.insurance_policy"
              >
              </v-text-field>
          </v-col>
         
        </v-row>

        <v-row>  
         
          <v-col md="2">
              <v-text-field
                label="Base Warranty"
                dense readonly filled
                v-model="vehicle.mfg_warr"
              >
              </v-text-field> 
          </v-col>
           
          <v-col md="2">
              <v-text-field
                label="Extended Warranty"
                dense readonly filled
                v-model="vehicle.ext_warr"
              >
              </v-text-field>
          </v-col>
          
          <v-col md="2">
              <v-text-field
                label="Ext. Warranty Provider"
                dense readonly filled
                v-model="vehicle.ext_warr_provider"
              >
              </v-text-field>
          </v-col>
          <v-col md="2">
              <v-text-field
                label="Ext. Warranty Contract"
                dense readonly filled
                v-model="vehicle.ext_warr_contract"
              >
              </v-text-field>
          </v-col>
          <v-col md="2">
              <v-text-field
                label="Ext. Warranty Phone"
                dense readonly filled
                v-model="vehicle.ext_warr_phone"
              >
              </v-text-field>
          </v-col>
          <v-col md="2">
              <v-text-field
                label="Avatar filename"
                dense readonly filled
                v-model="vehicle.avatar"
              >
              </v-text-field>
          </v-col>
         
        </v-row>
      </v-container>


      <div class="row">          
          <div class="col-md-10"> </div>
          <div class="col-md-2">
            <router-link :to="{ name: 'vehicles' }" class="btn btn-primary">Return</router-link>
          </div>
      </div>
  </div>

  
</template>

<script>
  export default {

      data() {
        return {
          vehicle: {}
        }
      },
      created() {
        console.log("showing..");
        let uri = `/api/vehicle/show/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.vehicle = response.data;
        });
      }
  }
</script>

