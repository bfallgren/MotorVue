<template>
  
  <div class="container">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link to="/" class="nav-link">Home</router-link>
        <li class="nav-item">
          <router-link to="/vehicles/index" class="nav-link">Vehicles</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/powerdevs/index" class="nav-link">Pwr Devices</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/links/index" class="nav-link">Links</router-link>
        </li>
      </ul>
      <li class="dropdown">
        <a id="navbarDropdown" class="btn dropdown-toggle" href="#" style="position:relative; top:0px; right:-10px; color:green" 
        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> Help
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <button class="dropdown-item btn btn-warning btn-sm" id="myBtn" data-toggle="modal" 
            data-target="#about">About</button>
            <button class="dropdown-item btn btn-warning btn-sm" id="buildBtn" data-toggle="modal" 
            data-target="#build">Build Info</button>
            <button class="dropdown-item btn btn-warning btn-sm" id="creditBtn" data-toggle="modal" 
            data-target="#credits">Credits</button>
            <button class="dropdown-item btn btn-warning btn-sm" id="feedbackBtn" data-toggle="modal" 
            data-target="#feedback">Feedback</button>
            <button class="dropdown-item btn btn-warning btn-sm" id="gsBtn" data-toggle="modal" 
            data-target="#gstarted">Getting Started</button>
        </div>                
    </li>
    </nav><br />
 
  <!-- About Modal -->
    <div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="feedbkModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: lightgreen">
                    
                    <h4 class="modal-title w-100" id="feedbkModalLabel">About: </h4>
                </div>
                <div class="modal-body">   
                    <div class="row">
                        <div class="col-md-12">
                            <h4> {{ app_name }} Version {{ app_ver }} </h4>
                        </div>
                    </div>
                    <div class="modal-footer" style="background-color: lightgreen">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <!-- Build Modal -->
    <div class="modal fade" id="build" tabindex="-1" role="dialog" aria-labelledby="buildModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: lightgreen">
                    
                    <h4 class="modal-title w-100" id="myModalLabel">Build Info: {{ app_name }} Version {{ app_ver }}</h4>
                </div>
                <div class="modal-body">   
                    <div class="row">
                        <div class="col-md-12">
                            <h5> Axios Version: {{ axiosVer }} </h5>
                            <h5> Bootstrap Version: {{ bootstrapVer }} </h5>
                            <h5> Jquery Version: {{ jqueryVer }} </h5>
                            <h5> Vue Version: {{ vueVer }} </h5>
                            <h5> PHP Version: 7.4 </h5>
                            <h5> MySql Version: 8.0.2.5 </h5>
                            <h5> FontAwesome version: 5.7.1</h5>
                            <h5> Laravel Version: 7.30 </h5>
                        </div>
                    </div>
                    <div class="modal-footer" style="background-color: lightgreen">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Credit Modal -->
    <div class="modal fade" id="credits" tabindex="-1" role="dialog" aria-labelledby="feedbkModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: lightgreen">
                    
                    <h4 class="modal-title w-100" id="feedbkModalLabel">Credits: </h4>
                </div>
                <div class="modal-body">   
                    <div class="row">
                        <div class="col-md-9">
                          <p>Stackoverflow.com</p>
                          <p>AppDividend.com</p>
                          <p>Medium.com</p>
                          <p>LaravelDocs</p>
                          <p>itsolutionstuff.com</p>
                          <p>ministackoverflow.com</p>
                          <p>laravel-news.com</p>
                          <p>easylaravelbook.com</p>
                          <p>auth0.com</p>
                          <p>snipe.net</p>
                          <p>codexworld.com</p>
                          <p>tutorialspoint.com</p>
                          <p>incoder.com</p>
                          <p>laravelcode.com</p>
                      </div>
                    </div>
                    <div class="modal-footer" style="background-color: lightgreen">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Feedback Modal -->
    <div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="feedbkModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: lightgreen">
                    
                    <h4 class="modal-title w-100" id="feedbkModalLabel">Feedback: </h4>
                </div>
                <div class="modal-body">   
                    <div class="row">
                        <div class="col-md-12">
                            <h4> Please send feedback to rjfallgren@gmail.com </h4>  
                        </div>
                    </div>
                    <div class="modal-footer" style="background-color: lightgreen">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Getting Started Modal -->
    <div class="modal fade" id="gstarted" tabindex="-1" role="dialog" aria-labelledby="feedbkModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: lightgreen">
                    
                    <h4 class="modal-title w-100" id="feedbkModalLabel">Getting Started: </h4>
                </div>
                <div class="modal-body">   
                    <div class="row">
                        <div class="col-md-12">
                            <p> Add Vehicle or Power Device (picture optional)</p>
                            <p> Add tasks (todos) and services (completed tasks) as needed </p>
                            <p> Create helpful Links including name, description and website address for reference </p>
                        </div>
                    </div>
                    <div class="modal-footer" style="background-color: lightgreen">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <transition name="fade">
      <router-view></router-view>
    </transition>
  </div>
</template>

<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }
    body {
      background-color: lightgray;
    }
</style>

<script>
    
    export default{
      data() {
        return {
          app_name: process.env.MIX_APP_NAME,
          app_ver: process.env.MIX_APP_VER,
          appVersion: this.application_version,
          axiosVer: this.axios_version,
          bootstrapVer: this.bootstrap_version, 
          jqueryVer: this.jquery_version,
          vueVer: this.vue_version
        }
      },
      mounted() {
       //console.log('app.vue version:', this.application_version);
      }
    }
</script>