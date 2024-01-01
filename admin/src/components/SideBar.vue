<template>
  <div class="flex">
    <aside
      class="bg-gray-800 text-gray-100 w-64 py-4 px-6 h-screen"
      :class="{ hidden: !showSidebar, block: showSidebar }"
    >
      <div class="flex items-center justify-between mb-5 mt-5">
        <h3 class="text-2xl font-bold tracking-wider ml-3">Admin</h3>
        <button
          class="md:hidden block p-2 rounded-md bg-gray-700 text-white mt-5 mx-auto"
          @click="toggleSidebar"
        >
          <svg
            v-if="showSidebar"
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16m-7 6h7"
            ></path>
          </svg>
          <svg
            v-else
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            ></path>
          </svg>
        </button>
      </div>

      <ul>
        <li>
          <router-link
            to="/"
            class="block py-2 px-4 hover:bg-gray-700 rounded transition duration-300"
            :class="{ 'bg-gray-700': $route.path === '/' }"
          >
            Dashboard
          </router-link>
        </li>
        <li>
          <router-link
            to="/attendee-management"
            class="block py-2 px-4 hover:bg-gray-700 rounded transition duration-300"
            :class="{ 'bg-gray-700': $route.path === '/attendee-management' }"
          >
            Attendee Management
          </router-link>
        </li>
        <li>
          <router-link
            to="/event-management"
            class="block py-2 px-4 hover:bg-gray-700 rounded transition duration-300"
            :class="{ 'bg-gray-700': $route.path === '/event-management' }"
          >
            Event Management
          </router-link>
        </li>
        <li>
          <router-link
            to="/profile"
            class="block py-2 px-4 hover:bg-gray-700 rounded transition duration-300"
            :class="{ 'bg-gray-700': $route.path === '/profile' }"
          >
            Profile
          </router-link>
        </li>
        <li>
          <router-link
            to="/settings"
            class="block py-2 px-4 hover:bg-gray-700 rounded transition duration-300"
            :class="{ 'bg-gray-700': $route.path === '/settings' }"
          >
            Settings
          </router-link>
        </li>
      </ul>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
      <!-- Your main content -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showSidebar: true,
    };
  },
  methods: {
    toggleSidebar() {
      this.showSidebar = !this.showSidebar;
    },
  },
};
</script>

<style scoped>
@media (max-width: 768px) {
  .bg-gray-800 {
    display: none;
  }
}
</style>
