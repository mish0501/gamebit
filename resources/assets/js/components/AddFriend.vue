<template>
  <form @submit.prevent="addFriend(username)">
    <transition name="fade">
      <div
        class="alert"
        role="alert"
        v-bind:class="[alert.type]"
        v-if="alert.message">
        {{alert.message}}
      </div>
    </transition>
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
    <hr>
  </form>
</template>

<script>
  export default {
    data () {
      return {
        username: '',
        alert: {
          type: '',
          message: ''
        }
      }
    },

    methods: {
      addFriend (username) {
        const data = { username };

        this.$http.post('/api/friendship', data)
          .then(response => {
            const data = response.data;

            if (data.success) {
              this.alert.type = 'alert-success';
              this.alert.message = data.success;
              return;
            }

            this.alert.type = 'alert-danger';
            this.alert.message = data[Object.keys(data)[0]][0];
          }, () => {
            this.alert.type = 'alert-danger';
            this.alert.message = 'Server failed.';
          });
      }
    }
  }
</script>
