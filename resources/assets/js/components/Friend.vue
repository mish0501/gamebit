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
      </div>
    </div>
  </div>
</template>
