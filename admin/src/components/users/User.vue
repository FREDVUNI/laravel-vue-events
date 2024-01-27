<template>
  <section class="container mx-auto px-5 py-10">
    <v-container>
      <v-row>
        <v-col>
          <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold mb-4">Users</h1>
            <router-link
              to="/settings"
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
              :items="usersData"
              :items-per-page="5"
            >
              <template v-slot:headers="{ headers }">
                <tr>
                  <th v-if="!isSmallScreen">#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th v-if="!isSmallScreen">Role</th>
                  <th></th>
                </tr>
              </template>

              <template v-slot:item="{ item, index }">
                <tr>
                  <td v-if="!isSmallScreen">{{ index + 1 }}</td>
                  <td>{{ item.name }}</td>
                  <td>{{ item.email }}</td>
                  <td v-if="!isSmallScreen">{{ item.role }}</td>
                  <td>
                    <v-icon @click="editUser(item)" class="mx-2"
                      >mdi-pencil</v-icon
                    >
                    <v-icon @click="deleteUser(item.id)" class="mx-2"
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
    const usersData = ref([]);
    const search = ref("");
    const isSmallScreen = ref(false);

    const headers = [
      { text: "#", value: "id" },
      { text: "Name", value: "name" },
      { text: "Email", value: "email" },
      { text: "Role", value: "role" },
      { text: "Actions", value: "actions" },
    ];

    const fetchUsersData = async () => {
      try {
        const response = await axios.get(`${url}/users`, setHeaders());
        usersData.value = response.data.users;
      } catch (error) {
        console.error(error);
      }
    };

    const editUser = (user) => {
      console.log("Edit user:", user);
    };

    const deleteUser = (userId) => {
      console.log("Delete user with ID:", userId);
    };

    const checkScreenSize = () => {
      isSmallScreen.value = window.innerWidth < 600;
    };

    onMounted(() => {
      fetchUsersData();
      checkScreenSize();
      window.addEventListener("resize", checkScreenSize);
    });

    return {
      usersData,
      search,
      headers,
      editUser,
      deleteUser,
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
