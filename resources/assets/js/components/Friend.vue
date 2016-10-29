<template>
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <h4 class="panel-title panel-title-button pull-left">Your friends</h4>

        <router-link
          :to="{ name: 'addFriend' }"
          class="btn btn-default pull-right"
          v-if="$route.name === 'friends'">
          Add friend
        </router-link>
        <router-link
          :to="{ name: 'friends' }"
          class="btn btn-primary pull-right"
          v-else>
          Add friend
        </router-link>
      </div>

      <div class="panel-body">
        <router-view></router-view>

        <div class="alert alert-info" role="alert" v-if="friends.length === 0">
          No friends bro.
        </div>

        <div class="media" v-for="friend in friends">
          <div class="media-left">
            <img class="media-object" src="http://godfatherstyle.com/wp-content/uploads/2016/02/pink-flower-images-and-wallpapers-21..jpg" alt="">
          </div>
          <div class="media-body">
            <h4 class="media-heading">{{friend.username}}</h4>
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
        friends: []
      };
    },

    mounted () {
      this.$http.post('/api/friendship/all')
        .then(response => {
          const friends = response.data
          if (friends.length === 0) {
            this.$router.push({ name: 'addFriend' });
          }

          this.friends = friends;
        }, error => {
          console.error(error);
        });
    }
  }
</script>
