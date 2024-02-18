<template>
  <section class="container mx-auto px-5 py-10">
    <v-container>
      <v-row>
        <v-col>
          <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold mb-4">Attendees</h1>
            <router-link
              to="/attendee-management/create"
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
              :items="attendeesData"
              :items-per-page="5"
            >
              <template v-slot:headers="{ headers }">
                <tr>
                  <th v-if="!isSmallScreen">#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th v-if="!isSmallScreen">Phone</th>
                  <th></th>
                </tr>
              </template>

              <template v-slot:item="{ item, index }">
                <tr>
                  <td v-if="!isSmallScreen">{{ index + 1 }}</td>
                  <td>{{ item.name }}</td>
                  <td>{{ item.email }}</td>
                  <td v-if="!isSmallScreen">{{ item.phone }}</td>
                  <td>
                    <router-link :to="'/attendee-management/edit/' + item.slug" class="mx-2">
                      <v-icon>mdi-pencil</v-icon>
                    </router-link>
                    <v-icon @click="deleteAttendee(item.id)" class="mx-2"
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

export default {
  setup() {
    const attendeesData = ref([]);
    const search = ref("");
    const isSmallScreen = ref(false);

    const headers = [
      { text: "#", value: "id" },
      { text: "Attendee", value: "attendee" },
      { text: "Date", value: "date" },
      { text: "Location", value: "location" },
      { text: "Actions", value: "actions" },
    ];

    const fetchattendeesData = async () => {
      try {
        const response = await axios.get(`${url}/attendees`, setHeaders());
        attendeesData.value = response.data.attendees;
      } catch (error) {
        console.error(error);
      }
    };

    const editAttendee = async (attendee) => {
      try {
        const response = await axios.get(`${url}/attendees`, setHeaders());
        attendeesData.value = response.data.attendees;
      } catch (error) {
        console.error(error);
      }
    };

    const deleteAttendee = (attendeeId) => {
      console.log("Delete attendee with ID:", attendeeId);
    };

    const checkScreenSize = () => {
      isSmallScreen.value = window.innerWidth < 600;
    };

    onMounted(() => {
      fetchattendeesData();
      checkScreenSize();
      window.addEventListener("resize", checkScreenSize);
    });

    return {
      attendeesData,
      search,
      headers,
      editAttendee,
      deleteAttendee,
      isSmallScreen,
    };
  },
};
</script>

<style>
.search-input {
  width: 300px;
}
</style>
