<template>
  <section class="container mx-auto px-5 py-10">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-semibold mb-4">Users</h1>
      <router-link
        to="/settings"
        class="bg-blue-500 text-white px-3 py-1 rounded"
        >Add</router-link
      >
    </div>
    <div class="max-w-full overflow-x-auto">
      <table
        class="w-full sm:max-w-sm md:max-w-3xl lg:max-w-4xl xl:max-w-5xl text-left text-sm whitespace-nowrap"
      >
        <thead class="uppercase tracking-wider border-b">
          <tr>
            <th scope="col" class="px-6 py-4 font-semibold">Name</th>
            <th scope="col" class="px-6 py-4 font-semibold">Email</th>
            <th scope="col" class="px-6 py-4 font-semibold">Role</th>
            <th scope="col" class="px-6 py-4 font-semibold">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-600"
            v-for="(user, index) in usersData"
            :key="index"
          >
            <td class="px-6 py-4">{{ user.name }}</td>
            <td class="px-6 py-4">{{ user.email }}</td>
            <td class="px-6 py-4">{{ user.role }}</td>
            <td class="px-6 py-4">
              <a class="text-green-500 hover:text-green-700" href="#"> Edit </a>
              <a class="text-red-500 hover:text-red-700" href="#"> Delete </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>
<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import { url, setHeaders } from "../api";

export default {
  setup() {
    const usersData = ref([]);

    const fetchUsersData = async () => {
      try {
        const response = await axios.get(`${url}users`, setHeaders());
        usersData.value = response.data.users;
        // console.log(usersData.value);
      } catch (error) {
        console.log(error);
      }
    };

    onMounted(() => {
      fetchUsersData();
    });

    return {
      usersData,
      fetchUsersData,
    };
  },
};
</script>
