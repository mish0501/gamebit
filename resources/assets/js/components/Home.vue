<template>
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">XP games (no bits)</div>

      <div class="panel-body">
        <div class="container-fluid">
          <div class="row">
            <div v-for="game in games.xp" class="col-md-4">
              <router-link
                :to="{ name: 'game', params: { id: game.id } }">
                {{game.name}}
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">XP&Bits games</div>

      <div class="panel-body">
        <div class="container-fluid">
          <div class="row">
            <div v-for="game in games.xpbits" class="col-md-4">
              <router-link
                :to="{ name: 'game', params: { id: game.id } }">
                {{game.name}}
              </router-link>
            </div>
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
        games: {}
      }
    },

    beforeCreate () {
      this.$http.post('/api/game')
        .then(response => {
          this.games = response.data;
        }, error => {
          console.error(error)
        });
    }
  }
</script>
