<template>
  <div>
    <h1>Add Vehicle</h1>
    <form @submit.prevent="addMotor">
      <v-container class="grey lighten-5">
        <v-row>  
         
          <v-col md="2">
              <v-text-field
                label="Year"
                type="number"
                min="2000"
                max="2500"
                dense filled
                v-model="motor.mfg_year"
               
               
              >
              </v-text-field> 
          </v-col>
           
          <v-col md="2">
              <v-text-field
                label="Make"
                dense filled
                v-model="motor.make"
              >
              </v-text-field>
          </v-col>
          
          <v-col md="2">
              <v-text-field
                label="Model"
                dense filled
                v-model="motor.model"
              >
              </v-text-field>
          </v-col>
          <v-spacer></v-spacer>
        </v-row>

        <v-row>  
         
          <v-col md="2">
              <v-text-field
                label="Current Mileage"
                dense filled
                v-model="motor.current_mileage"
                type="number"
                required
                min="1"
              >
              </v-text-field> 
          </v-col>
           
          <v-col md="2">
              <v-text-field
                label="VIN"
                size="17" minlength="17" maxlength="17"
                dense filled
                v-model="motor.vid"
              >
              </v-text-field>
          </v-col>
          
          <v-col md="2">
              <v-text-field
                label="License Tag"
                maxlength="8"
                dense filled
               v-model="motor.license_tag"
              >
              </v-text-field>
          </v-col>
          <v-col md="2">
              <v-text-field
                label="Ins. Provider"
                maxlength="50"
                dense filled
                v-model="motor.insurance_provider"
              >
              </v-text-field>
          </v-col>
          <v-col md="2">
              <v-text-field
                label="Ins. Policy"
                maxlength="50"
                dense filled
                v-model="motor.insurance_policy"
              >
              </v-text-field>
          </v-col>
         
        </v-row>

        <v-row>  
         
          <v-col md="2">
              <v-text-field
                label="Base Warranty"
                maxlength="20"
                dense filled
                v-model="motor.mfg_warr"
              >
              </v-text-field> 
          </v-col>
           
          <v-col md="2">
              <v-text-field
                label="Extended Warranty"
                maxlength="20"
                dense filled
                v-model="motor.ext_warr"
              >
              </v-text-field>
          </v-col>
          
          <v-col md="2">
              <v-text-field
                label="Ext. Warranty Provider"
                maxlength="50"
                dense filled
                v-model="motor.ext_warr_provider"
              >
              </v-text-field>
          </v-col>
          <v-col md="2">
              <v-text-field
                label="Ext. Warranty Contract"
                maxlength="50"
                dense filled
                v-model="motor.ext_warr_contract"
              >
              </v-text-field>
          </v-col>
          <v-col md="2">
              <v-text-field
                label="Ext. Warranty Phone"
                placeholder="555-555-1212" 
                pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                dense filled
                v-model="motor.ext_warr_phone"
              >
              </v-text-field>
          </v-col>
         
        </v-row>
      </v-container>
            
      <div class="row">
        
        <div class="col-md-5 offset-md-1">
          
          <form>
            <div class="form-group">
              <label for="my-file">Select Avatar Image</label>
              <input type="file" accept="image/*" @change="previewImage" class="form-control-file" id="my-file">
        
              <div class="border p-2 mt-3">
                <p>Preview Here:</p>
                <template v-if="preview">
                  <img :src="preview" class="img-fluid" />
                  <p class="mb-0">file name: {{ image.name }}</p>
                  <p class="mb-0">size: {{ image.size/1024 }}KB</p>
                </template>
              </div>
            </div>
          </form>
        </div>
      </div>

        <div class="md-col-12">
          <div class="form-group">
            <button class="btn btn-primary">Create</button>
          </div>
        </div>
        
    </form>
  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";

  export default {
    data() {
        return {
          motor: {}, 
          img: [],
          preview: null,
          image: null
        }
      },
    
   
    
    methods: {
        previewImage: function(event) {
          var input = event.target;
          if (input.files) {
            var reader = new FileReader();
            reader.onload = (e) => {
              this.preview = e.target.result;
            }
            this.image=input.files[0];
            reader.readAsDataURL(input.files[0]);
          }
        },
      addMotor(){
        console.log("adding motor");
        var app = this;
        let uri = '/api/motor/create';
         if (this.image) {
          this.motor.avatar = this.image.name; /* derived from previewImage method */
         }
        this.axios.post(uri, this.motor)
           .then(function (resp) {
              Swal.fire({              
                text: "Vehicle Inserted",
                icon: 'success',
                timer: 6000
              }).then(function() {
                // Redirect the user
                window.location.href = "/vehicles/index";
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
                console.log(resp.response.data.errors);               
              }
            });
      }   
    }
  }
</script>
