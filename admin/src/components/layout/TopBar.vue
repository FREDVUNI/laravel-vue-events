<template>
  <header class="bg-white shadow-sm">
    <div class="flex items-center justify-end px-5 py-2">
      <div
        class="flex items-center hover:cursor-pointer"
        @click="toggleDropdown"
      >
        <img
          src="https://www.f6s.com/content-resource/profiles/3610847_th2.jpg"
          alt="Profile"
          class="h-8 w-8 rounded-full"
        />
        <span class="ml-2 text-gray-800">Fred</span>
        <div class="relative ml-2">
          <button class="focus:outline-none">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5 text-gray-600"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                clip-rule="evenodd"
              />
              <path
                fill-rule="evenodd"
                d="M0 6a6 6 0 1110.268 3.902c1.35-.665 2.769-1.048 4.232-1.175A5.99 5.99 0 0110 16a5.99 5.99 0 01-4.5-2.073c1.463.127 2.882.51 4.232 1.175A6 6 0 010 6zm2 0a4 4 0 118 0 4 4 0 01-8 0z"
                clip-rule="evenodd"
              />
            </svg>
          </button>
          <div
            v-if="isDropdownOpen"
            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1"
          >
            <router-link
              to="/"
              class="block px-4 py-2 text-gray-800 hover:bg-gray-200"
              >Dashboard</router-link
            >
            <router-link
              to="/users"
              class="block px-4 py-2 text-gray-800 hover:bg-gray-200"
              >Users</router-link
            >
            <router-link
              to="/attendee-management"
              class="block px-4 py-2 text-gray-800 hover:bg-gray-200"
              >Attendees</router-link
            >
            <router-link
              to="/event-management"
              class="block px-4 py-2 text-gray-800 hover:bg-gray-200"
              >Events</router-link
            >
            <router-link
              to="/settings"
              class="block px-4 py-2 text-gray-800 hover:bg-gray-200"
              >Settings</router-link
            >
            <router-link
              to="/profile"
              class="block px-4 py-2 text-gray-800 hover:bg-gray-200"
              >Profile</router-link
            >
            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200"
              >Logout</a
            >
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref } from "vue";

const isDropdownOpen = ref(false);

function toggleDropdown() {
  isDropdownOpen.value = !isDropdownOpen.value;
}
</script>

<style scoped>
/* Add any additional scoped styles if needed */
</style>
