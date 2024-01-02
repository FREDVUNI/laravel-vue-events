<template>
  <section class="container mx-auto px-5 py-10">
    <h1 class="text-2xl font-semibold mb-4">Attendees</h1>
    <div class="max-w-full">
      <table
        class="w-full sm:max-w-sm md:max-w-3xl lg:max-w-4xl xl:max-w-5xl text-left text-sm whitespace-nowrap"
      >
        <thead class="uppercase tracking-wider border-b">
          <tr>
            <th scope="col" class="px-6 py-4">Name</th>
            <th scope="col" class="px-6 py-4">Phone</th>
            <th scope="col" class="px-6 py-4">Email</th>
            <th scope="col" class="px-6 py-4">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-600"
            v-for="(event, index) in eventsData"
            :key="index"
          >
            <td class="px-6 py-4">{{ event.name }}</td>
            <td class="px-6 py-4">{{ event.phone }}</td>
            <td class="px-6 py-4">{{ event.email }}</td>
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
export default {
  data() {
    return {
      eventsData: [
        {
          name: "Event A",
          phone: "2023-01-01",
          email: "Venue X",
        },
        {
          name: "Event B",
          phone: "2023-02-02",
          email: "Venue Y",
        },
        {
          name: "Event C",
          phone: "2023-03-03",
          email: "Venue Z",
        },
        {
          name: "Event D",
          phone: "2023-04-04",
          email: "Venue W",
        },
        {
          name: "Event E",
          phone: "2023-05-05",
          email: "Venue P",
        },
      ],
    };
  },
};
</script>
