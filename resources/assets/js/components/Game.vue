<template>
  <div class="col-md-8 col-md-offset-2">
    <div class="container-fluid">
      <div class="col-md-12">
        <h1>{{game.name}}</h1>
        <p>{{game.description}}</p>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-body">
            <div
              @click="createRoom"
              class="btn btn-success">
              Create a room
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-body">
            <join-game></join-game>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        game: {}
      }
    },

    beforeCreate () {
      const data = {
        id: this.$route.params.id
      };

      this.$http.post(`/api/game`, data)
        .then(response => {
          if (response.data.id[0]) {
            this.$router.replace({ name: 'games' });
            return;
          }

          this.game = response.data;
        }, error => {
          console.error(error);
        });
    },

    methods: {
      createRoom () {
        const data = {
          game_id: this.$route.params.id
        };

        this.$http.post('/api/room', data)
          .then(response => {
            this.$router.push(`/app/room/${response.data}`);
          }, error => {
            console.error(error);
          });
      }
    }
  }
</script>
