<template>
  <div>
    <li v-for="(message, index) in messageList" :item="message" :key="index">
      {{ message }}
    </li>
  </div>
</template>

<script>
export default {
  name: "Results",
  props: {
    msg: {
      type: String
    }
  },
  data: function() {
    return {
      messageList: []
    };
  },
  watch: {
    msg: function() {
      this.messageList.push(this.msg);
    }
  }
};
</script>
