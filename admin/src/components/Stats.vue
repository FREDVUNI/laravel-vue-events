<template>
  <div class="bg-white rounded-lg shadow p-6">
    <!-- Statistics Content -->
    <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ title }}</h2>
    <p class="text-gray-600">{{ description }}</p>
  </div>
</template>

<script>
export default {
  props: {
    title: String,
    description: String,
    // Add more props as needed for stats
  },
  // Add logic if needed
};
</script>

<style scoped>
/* Add your styles here */
</style>
