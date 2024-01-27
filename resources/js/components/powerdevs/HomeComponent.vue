<template>
  <div class="row justify-content-center">
      <div class="col-md-8">
         <img :src="'/image/garage.jpg'"  width="768" height="576">
        </div>
  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
