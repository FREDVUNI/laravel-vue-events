<template>
  <div class="flex items-center justify-center h-screen">
    <div class="bg-white rounded-lg p-6">
      <h1 class="text-4xl font-semibold mb-4">404 - Not Found</h1>
      <p class="text-gray-600 mb-4">
        Oops! The page you're looking for does not exist.
      </p>
      <router-link to="/" class="text-blue-500 hover:underline"
        >Go back to Home</router-link
      >
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    goBack() {
      this.$router.go(-1);
    },
  },
};
</script>

<style scoped>
/* Add scoped styles if needed */
</style>
