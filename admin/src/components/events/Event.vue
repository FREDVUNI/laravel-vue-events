<template>
  <section class="container mx-auto px-5 py-10">
    <v-container>
      <v-row>
        <v-col>
          <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold mb-4">Events</h1>
            <router-link
              to="/event-management/create"
              class="bg-blue-500 text-white px-3 py-1 rounded"
              >Add</router-link
            >
          </div>
          <v-card flat>
            <v-card-title class="d-flex align-center">
              <div>
                <v-text-field
                  v-model="search"
                  prepend-inner-icon="mdi-magnify"
                  density="compact"
                  label="Search"
                  single-line
                  flat
                  hide-details
                  variant="solo-filled"
                  class="search-input"
                ></v-text-field>
              </div>
            </v-card-title>
            <v-divider></v-divider>

            <v-data-table
              v-model:search="search"
              :items="eventsData"
              :items-per-page="5"
            >
              <template v-slot:headers="{ headers }">
                <tr>
                  <th v-if="!isSmallScreen">#</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th v-if="!isSmallScreen">Start Date</th>
                  <th v-if="!isSmallScreen">End Date</th>
                  <th></th>
                </tr>
              </template>

              <template v-slot:item="{ item, index }">
                <tr>
                  <td v-if="!isSmallScreen">{{ index + 1 }}</td>
                  <td>{{ item.title }}</td>
                  <td>{{ shortenDetails(item.description, 10) }}</td>
                  <td v-if="!isSmallScreen">
                    {{ formatDateTime(item.start_date) }}
                  </td>
                  <td v-if="!isSmallScreen">
                    {{ formatDateTime(item.end_date) }}
                  </td>
                  <td>
                    <v-icon
                      @click="() => editEvent(item.slug)"
                      class="mx-2 cursor-pointer"
                      >mdi-pencil</v-icon
                    >
                    <v-icon
                      @click="() => deleteEvent(item.id)"
                      class="mx-2 cursor-pointer"
                      >mdi-delete</v-icon
                    >
                  </td>
                </tr>
              </template>
            </v-data-table>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </section>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import { url, setHeaders } from "../api";
import { shortenDetails, formatDateTime } from "../../utils";
import { useRouter } from "vue-router";

export default {
  setup() {
    const router = useRouter();
    const eventsData = ref([]);
    const search = ref("");
    const isSmallScreen = ref(false);

    const headers = [
      { text: "#", value: "id" },
      { text: "Event", value: "event" },
      { text: "Date", value: "date" },
      { text: "Description", value: "description" },
      { text: "Actions", value: "actions" },
    ];

    const fetchEventsData = async () => {
      try {
        const response = await axios.get(`${url}/events`, setHeaders());
        eventsData.value = response.data.events;
      } catch (error) {
        console.error(error);
      }
    };

    const editEvent = (slug) => {
      router.push(`/event-management/edit/${slug}`);
    };

    const deleteEvent = (slug) => {
      console.log("Delete event with ID:", slug);
    };

    const checkScreenSize = () => {
      isSmallScreen.value = window.innerWidth < 600;
    };

    onMounted(() => {
      fetchEventsData();
      checkScreenSize();
      window.addEventListener("resize", checkScreenSize);
    });

    return {
      eventsData,
      search,
      headers,
      editEvent,
      deleteEvent,
      isSmallScreen,
      shortenDetails,
      formatDateTime,
    };
  },
};
</script>

<style>
.search-input {
  width: 300px;
}
</style>
