<template>
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">XP games (no bits)</div>

      <div class="panel-body">
        <div class="container-fluid">
          <div class="row">
            <div v-for="game in games.xp" class="col-md-4">
              <router-link class="game text-center" :to="{ name: 'game', params: { id: game.id } }">
                  <svg class="sheet" xmlns="http://www.w3.org/2000/svg" viewBox="-439 257 41 53"><path fill="#F4F4F4" d="M-412 257h-27v53h41v-53"/><g fill="#CCC"><path d="M-431 276.5h25c.6 0 1-.4 1-1s-.4-1-1-1h-25c-.6 0-1 .4-1 1s.4 1 1 1zM-406 282.5h-25c-.6 0-1 .4-1 1s.4 1 1 1h25c.6 0 1-.4 1-1s-.4-1-1-1zM-406 290.5h-25c-.6 0-1 .4-1 1s.4 1 1 1h25c.6 0 1-.4 1-1s-.4-1-1-1zM-406 298.5h-25c-.6 0-1 .4-1 1s.4 1 1 1h25c.6 0 1-.4 1-1s-.4-1-1-1zM-431 268.5h25c.6 0 1-.4 1-1s-.4-1-1-1h-25c-.6 0-1 .4-1 1s.4 1 1 1z"/></g></svg>
                  <h3>{{game.name}}</h3>
                  <h4>{{game.description}}</h4>
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
      this.$http.post('/api/game/all')
        .then(response => {
          this.games = response.data;
        }, error => {
          console.error(error)
        });
    }
  }
</script>
