<template>
  <form @submit.prevent="addFriend(username)">
    <div class="input-group">
      <input
        v-model="username"
        type="text"
        class="form-control"
        placeholder="Friend's username">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Add</button>
      </span>
    </div>
  </form>
</template>

<script>
  export default {
    data () {
      return {
        username: ''
      }
    },

    methods: {
      addFriend (username) {
        const data = { username };
        this.$http.post('/api/friendship', data)
          .then(response => {
            console.log(response);
          }, error => {
            console.log(error);
          });
      }
    }
  }
</script>
