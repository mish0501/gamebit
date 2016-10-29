<template>
  <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-bell"></i>
          <span class="badge">{{requests.length}}</span>
          <b class="caret"></b>
      </a>
      <ul class="dropdown-menu requests-dropdown">
        <li class="dropdown-header">Friend requests</li>
        <li class="request" v-if="requests.length === 0">
          <h4>No friend request.</h4>
        </li>
        <li class="request" v-for="request in requests">
          <div class="media">
              <div class="media-left">
                  <img class="media-object" src="http://godfatherstyle.com/wp-content/uploads/2016/02/pink-flower-images-and-wallpapers-21..jpg" alt="">
              </div>
              <div class="media-body">
                  <h4 class="media-heading">{{request.name}} ({{request.username}})</h4>
                  <button @click="accept(request)" class="btn btn-success">Accept</button>
                  <button @click="deny(request)" class="btn btn-danger">Deny</button>
              </div>
          </div>
        </li>
      </ul>
  </li>
</template>

<script>
  export default {
    data () {
      return {
        requests: []
      };
    },

    mounted () {
      this.$http.get('/api/user')
        .then(response => {
          Echo.private(`App.User.${response.data.id}`)
            .notification((notification) => {
                this.requests.unshift(notification.user);
            });
        }, error => {
          this.$router.replace({ name: 'home' });
        });

      this.$http.post('/api/friendship/request')
        .then(response => {
          const requests = response.data
          this.requests = requests;
        }, error => {
          console.error(error);
        });
    },

    methods: {
      accept (request) {
        this.$http.put('/api/friendship/accept', { id: request.id })
          .then(response => {
            const index = this.requests.indexOf(request);
            this.requests.splice(index, 1);
          }, error => {
            console.error(error);
          });
      },

      deny (request) {
        this.$http.put('/api/friendship/deny', { id: request.id })
          .then(response => {
            const index = this.requests.indexOf(request);
            this.requests.splice(index, 1);
          }, error => {
            console.error(error);
          });
      }
    }
  }
</script>