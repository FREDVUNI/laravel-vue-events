<template>
  <div id="app" class="flex h-screen">
    <SideBar />
    <div class="flex flex-1 flex-col">
      <TopBar class="w-full" />
      <div class="flex-1">
        <router-view />
      </div>
    </div>
  </div>
</template>

<script setup>
import { RouterView } from "vue-router";
import SideBar from "./components/SideBar.vue";
import TopBar from "./components/TopBar.vue";
</script>

<style scoped>
/* Add any additional scoped styles if needed */
</style>
