<template>
  <main class="flex-1 p-4">
    <div class="bg-white rounded-lg p-6">
      <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-blue-200 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-2">Total Events</h2>
          <p class="text-gray-700">150</p>
        </div>
        <div class="bg-green-200 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-2">Upcoming Events</h2>
          <p class="text-gray-700">40</p>
        </div>
        <div class="bg-yellow-200 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-2">Registered Users</h2>
          <p class="text-gray-700">1200</p>
        </div>
        <div class="bg-red-200 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-2">Tickets Sold</h2>
          <p class="text-gray-700">3000</p>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {};
</script>

<style scoped>
/* Add scoped styles if needed */
</style>
