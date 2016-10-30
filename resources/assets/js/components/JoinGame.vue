<template>
  <form @submit.prevent="joinGame(roomCode)">
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
        v-model="roomCode"
        type="text"
        class="form-control"
        placeholder="Enter the room code">
      <span class="input-group-btn">
        <button class="btn btn-primary" type="submit">Join</button>
      </span>
    </div>
  </form>
</template>

<script>
  export default {
    data () {
      return {
        roomCode: '',
        alert: {
          type: '',
          message: ''
        }
      }
    },

    methods: {
      joinGame (roomCode) {
        const data = {
          room_code: roomCode
        };

        this.$http.put('/api/room/join', data)
          .then(response => {
            const data = response.data;

            if (data.success) {
              this.alert.type = 'alert-success';
              this.alert.message = data.success;
              return;
            }

            if (data.join === true) {
              this.$router.push({ name: 'room', params: { code: roomCode } });
            }
          }, () => {
            this.alert.type = 'alert-danger';
            this.alert.message = 'Server failed.';
          });
      }
    }
  }
</script>