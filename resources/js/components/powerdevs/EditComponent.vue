<template>
  <div>
    <h1>Edit Power Device</h1>
    <form @submit.prevent="updateMotor">
    
      <v-container class="grey lighten-5">
        <v-row>  
         
          <v-col md="1">
              <v-text-field
                label="Year"
                dense readonly filled
                v-model="motor.mfg_year"               
              >
              </v-text-field> 
          </v-col>
           
          <v-col md="2">
              <v-text-field
                label="Make"
                dense readonly filled
                v-model="motor.make"
              >
              </v-text-field>
          </v-col>
          
          <v-col md="2">
              <v-text-field
                label="Model"
                dense readonly filled
                v-model="motor.model"
              >
              </v-text-field>
          </v-col>
          <v-spacer></v-spacer>
        </v-row>

        <v-row>  
         
          <v-col md="2">
              <v-text-field
                label="Current Hours"
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
                label="Serial No."
                size="17" minlength="5" maxlength="17"
                dense filled
                v-model="motor.vid"
              >
              </v-text-field>
          </v-col>      
                   
        </v-row>

        <v-row>  
                   
          <v-col md="2">
              <v-text-field
                label="Avatar filename"
                dense filled
                v-model="motor.avatar"
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
          <button class="btn btn-success">Update</button>
          <router-link :to="{ name: 'powerdevs' }" class="btn btn-warning">Cancel</router-link>
        </div>
      </div>
    </form>

    
  </div>
</template>

<script>
  export default {

      data() {
        return {
          motor: {},
          img: [],
          preview: null,
          image: null
        }
      },

      created() {
        console.log("edit-started");
        let uri = `/api/motor/edit/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.motor = response.data;
        });
      },

      methods: {
        updateMotor() {
          console.log("edit-completed");
          let uri = `/api/motor/update/${this.$route.params.id}`;
                         
          if (this.image) {
            this.motor.avatar = this.image.name; /* derived from previewImage method */
          }
          this.axios.post(uri, this.motor).then((response) => {
            this.$router.push({path: '/powerdevs/index'});
          });
        },

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
        
      }
      
  }
</script>
