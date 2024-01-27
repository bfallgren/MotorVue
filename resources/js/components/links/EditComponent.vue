<template>
  <div>
    <h1>Edit Link</h1>
    <form @submit.prevent="updateLink">
    
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
          <button class="btn btn-success">Update</button>
          <router-link :to="{ name: 'links' }" class="btn btn-warning">Cancel</router-link>
        </div>
      </div>
    </form>

    
  </div>
</template>

<script>
  export default {

      data() {
        return {
          link: {}
        }
      },

      created() {
        console.log("edit-started");
        let uri = `/api/links/edit/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.link = response.data;
        });
      },

      methods: {
        updateLink() {
          console.log("edit-completed");
          let uri = `/api/links/update/${this.$route.params.id}`;
          this.axios.post(uri, this.link).then((response) => {
            this.$router.push({path: '/links/index'});
          });
        }       
      }     
  }
</script>
