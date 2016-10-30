<template>
  <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-bell"></i>
          <span class="badge">{{notifications.length}}</span>
          <b class="caret"></b>
      </a>
      <ul class="dropdown-menu requests-dropdown">
        <li class="dropdown-header">Notifications</li>
        <li class="request" v-if="notifications.length === 0">
          <h4>No notifications.</h4>
        </li>
        <li class="request" v-for="notification in notifications">
          <div class="media">
              <div class="media-left">
                  <img class="media-object" src="http://godfatherstyle.com/wp-content/uploads/2016/02/pink-flower-images-and-wallpapers-21..jpg" alt="">
              </div>
              <div class="media-body">
                  <h4 class="media-heading" v-if="notification.type === 'App\\Notifications\\FriendRequestNotification'">
                    {{notification.user.name}} ({{notification.user.username}}) wants to be friend with you.
                  </h4>
                  <h4 class="media-heading" v-if="notification.type === 'App\\Notifications\\InviteFriendNotification'">
                    {{notification.user.name}} ({{notification.user.username}}) invited you to play a game.
                  </h4>
                  <button @click="accept(notification)" class="btn btn-success">Accept</button>
                  <button @click="deny(notification)" class="btn btn-danger">Deny</button>
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
        notifications: []
      };
    },

    computed: {
      authUserId () {
        return this.$store.getters.authUser.id;
      }
    },

    watch: {
      authUserId (authUserId) {
        if (authUserId) {
          Echo.private(`App.User.${authUserId}`)
            .notification((notification) => {
              this.notifications.unshift(notification);
            });
        }
      }
    },

    mounted () {
      this.$http.post('/api/user/notifications')
        .then(response => {
          const notifications = [];

          for (let i = 0, length = response.data.length; i < length; i += 1) {
            const notification = {
              id: response.data[i].id,
              type: response.data[i].type,
            };

            Object.assign(notification, response.data[i].data);

            notifications.push(notification);
          }

          this.notifications = notifications;
        }, error => {
          console.error(error);
        });
    },

    methods: {
      accept (notification) {
        let path, data;

        if (notification.type === 'App\\Notifications\\FriendRequestNotification') {
          path = '/api/friendship/accept';
          data = {
            id: notification.user.id,
            notification_id: notification.id
          };
        } else if (notification.type === 'App\\Notifications\\InviteFriendNotification') {
          path = '/api/room/join';
          data = {
            room_code: notification.room_code,
            notification_id: notification.id
          };
        }

        console.log(data);

        this.$http.put(path, data)
          .then(response => {
            const index = this.notifications.indexOf(notification);
            this.notifications.splice(index, 1);

            if (response.data.join === true) {
              const roomCode = notification.room_code;
              this.$router.push({
                name: 'room',
                params: {
                  code: roomCode
                }
              });
            }
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