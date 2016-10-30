<template>
  <router-view></router-view>
</template>

<script>
  export default {
    beforeCreate () {
      this.$store.dispatch('setAuthUser');
      this.$store.dispatch('setFriends');
    }
  }
</script>
