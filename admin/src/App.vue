<script setup>
import { RouterView } from "vue-router";
import SideBar from "./components/SideBar.vue";
import TopBar from "./components/TopBar.vue";
</script>

<template>
  <div id="app">
    <TopBar />
    <div class="flex">
      <SideBar />
      <router-view />
    </div>
  </div>
</template>

<style scoped>
/* Add any additional scoped styles if needed */
</style>
