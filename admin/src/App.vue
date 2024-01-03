<template>
  <div id="app" class="flex h-screen">
    <template
      v-if="
        !$route.name ||
        ($route.name !== 'signin' && $route.name !== 'not-found')
      "
    >
      <SideBar />
      <div class="flex flex-1 flex-col">
        <TopBar class="w-full" />
        <div class="flex-1">
          <router-view />
        </div>
      </div>
    </template>
    <template v-else>
      <div class="flex-1">
        <router-view />
      </div>
    </template>
  </div>
</template>

<script setup>
import { RouterView } from "vue-router";
import SideBar from "./components/layout/SideBar.vue";
import TopBar from "./components/layout/TopBar.vue";
</script>

<style scoped>
/* Add any additional scoped styles if needed */
</style>
