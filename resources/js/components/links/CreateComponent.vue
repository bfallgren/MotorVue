<template>
  <div>
    <h1>Add Link</h1>
    <form @submit.prevent="addLink">
      <v-container class="grey lighten-5">
        <v-row>       
          <v-col md="4">
              <v-textarea
                label="Name"
                size="32" maxlength="32"
                required
                rows="2"
                row-height="20"
                variant = "filled"
                clearable no-resize 
                v-model="link.name"
              >
              </v-textarea> 
          </v-col>
           
          <v-col md="4">
              <v-textarea
                label="Description"
                size="64" maxlength="64"
                required
                rows="2"
                row-height="20"
                variant = "filled"
                clearable no-resize 
                v-model="link.description"

                
              >
              </v-textarea>
          </v-col>
          
          <v-col md="4">
              <v-textarea
                label="URL"
                size="128" maxlength="128"
                required
                 rows="2"
                 row-height="20"
                 variant = "filled"
                clearable no-resize 
                v-model="link.urlname"
              >
              </v-textarea>
          </v-col>
          <v-spacer></v-spacer>
        </v-row>

      </v-container>

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
          link: {}, 
        }
      },
    
    methods: {
      addLink(){
        console.log("adding link");
        var app = this;
        let uri = '/api/links/create';   
        this.axios.post(uri, this.link)
           .then(function (resp) {
              Swal.fire({              
                text: "Link Inserted",
                icon: 'success',
                timer: 6000
              }).then(function() {
                // Redirect the user
                window.location.href = "/links/index";
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
