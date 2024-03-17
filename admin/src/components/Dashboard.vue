<template>
  <main class="flex-1 p-4">
    <div class="bg-white rounded-lg p-6">
      <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-blue-200 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-2">Total Events</h2>
          <p class="text-gray-700">{{ events_count }}</p>
        </div>
        <div class="bg-green-200 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-2">Upcoming Events</h2>
          <p class="text-gray-700">{{ upcoming_events_count }}</p>
        </div>
        <div class="bg-yellow-200 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-2">Registered Users</h2>
          <p class="text-gray-700">{{ users_count }}</p>
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
import axios from "axios";
import { setHeaders, url } from "./api";
export default {
  data() {
    return {
      users_count: 0,
      events_count: 0,
      upcoming_events_count: 0,
      sold_tickets_count: 0,
    };
  },
  methods: {
    async get_users_count() {
      try {
        const response = await axios.get(
          `${url}/users/users-count`,
          setHeaders()
        );
        this.users_count = response.data.count;
      } catch (error) {
        console.log(error);
      }
    },
    async get_events_count() {
      try {
        const response = await axios.get(
          `${url}/events/events-count`,
          setHeaders()
        );
        this.events_count = response.data.count;
      } catch (error) {
        console.log(error);
      }
    },
    async get_upcoming_events_count() {
      try {
        const response = await axios.get(
          `${url}/events/upcoming-events-count`,
          setHeaders()
        );
        this.upcoming_events_count = response.data.count;
      } catch (error) {
        console.log(error);
      }
    },
    async get_tickets_sold_count() {
      try {
        const response = await axios.get(
          `${url}/tickets/sold-tickets-count`,
          setHeaders()
        );
        this.sold_tickets_count = response.data.count;
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.get_users_count();
    this.get_events_count();
    this.get_upcoming_events_count();
    this.get_tickets_sold_count();
  },
};
</script>

<style scoped>
/* Add scoped styles if needed */
</style>
