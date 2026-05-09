<template>
  <main class="flex-1 p-4">
    <div class="bg-white rounded-lg p-6">
      <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>

      <!-- Stat Cards Row -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-blue-200 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-2">Total Events</h2>
          <p class="text-gray-700">{{ stats.total_events }}</p>
        </div>
        <div class="bg-green-200 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-2">Upcoming Events</h2>
          <p class="text-gray-700">{{ stats.upcoming_events }}</p>
        </div>
        <div class="bg-yellow-200 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-2">Registered Users</h2>
          <p class="text-gray-700">{{ stats.registered_users }}</p>
        </div>
        <div class="bg-red-200 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-2">Tickets Sold</h2>
          <p class="text-gray-700">{{ stats.sold_tickets }}</p>
        </div>
        <!-- Additional Stats -->
        <div class="bg-purple-200 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-2">Total Attendees</h2>
          <p class="text-gray-700">{{ stats.total_attendees }}</p>
        </div>
        <div class="bg-indigo-200 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-2">Total Revenue</h2>
          <p class="text-gray-700">${{ stats.total_revenue }}</p>
        </div>
      </div>

      <!-- Charts Row -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
        <div class="bg-gray-50 p-4 rounded-lg shadow">
          <h2 class="text-lg font-semibold mb-4">Tickets Sold per Month</h2>
          <Line
            v-if="ticketsChartData"
            :data="ticketsChartData"
            :options="chartOptions"
          />
        </div>
        <div class="bg-gray-50 p-4 rounded-lg shadow">
          <h2 class="text-lg font-semibold mb-4">Events Created per Month</h2>
          <Bar
            v-if="eventsChartData"
            :data="eventsChartData"
            :options="chartOptions"
          />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import axios from "axios";
import { setHeaders, url } from "./api";
import { Line, Bar } from "vue-chartjs";
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  BarElement,
  Title,
  Tooltip,
  Legend,
} from "chart.js";

// Register Chart.js components
ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  BarElement,
  Title,
  Tooltip,
  Legend,
);

export default {
  components: { Line, Bar },
  data() {
    return {
      stats: {
        total_events: 0,
        upcoming_events: 0,
        registered_users: 0,
        sold_tickets: 0,
        total_attendees: 0,
        total_revenue: 0,
      },
      ticketsChartData: null,
      eventsChartData: null,
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
      },
    };
  },
  methods: {
    async fetchDashboardStats() {
      try {
        const response = await axios.get(
          `${url}/dashboard-stats`,
          setHeaders(),
        );
        const data = response.data;

        // Update stats
        this.stats = {
          total_events: data.total_events,
          upcoming_events: data.upcoming_events,
          registered_users: data.registered_users,
          sold_tickets: data.sold_tickets,
          total_attendees: data.total_attendees,
          total_revenue: data.total_revenue,
        };

        // Prepare tickets per month chart data
        const monthLabels = [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ];
        const ticketsData = Array(12).fill(0);
        if (data.tickets_per_month) {
          for (const [month, count] of Object.entries(data.tickets_per_month)) {
            ticketsData[month - 1] = count;
          }
        }
        this.ticketsChartData = {
          labels: monthLabels,
          datasets: [
            {
              label: "Tickets Sold",
              backgroundColor: "#4f81bd",
              borderColor: "#385d8a",
              data: ticketsData,
              tension: 0.3,
            },
          ],
        };

        // Prepare events per month chart data (bar)
        const eventsData = Array(12).fill(0);
        if (data.events_per_month) {
          for (const [month, count] of Object.entries(data.events_per_month)) {
            eventsData[month - 1] = count;
          }
        }
        this.eventsChartData = {
          labels: monthLabels,
          datasets: [
            {
              label: "Events Created",
              backgroundColor: "#c0504d",
              data: eventsData,
            },
          ],
        };
      } catch (error) { 
        console.error(error);
      }
    },
  },
  mounted() {
    this.fetchDashboardStats();
  },
};
</script>

<style scoped>
/* Add any scoped styles if needed */
</style>
