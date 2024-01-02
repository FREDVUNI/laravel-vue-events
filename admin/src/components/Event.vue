<template>
  <section class="container mx-auto px-5 py-10">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-semibold mb-4">Events</h1>
      <button class="bg-blue-500 text-white px-3 py-1 rounded">Add</button>
    </div>
    <div class="max-w-full overflow-x-auto">
      <table
        class="w-full sm:max-w-sm md:max-w-3xl lg:max-w-4xl xl:max-w-5xl text-left text-sm whitespace-nowrap"
      >
        <thead class="uppercase tracking-wider border-b">
          <tr>
            <th scope="col" class="px-6 py-4">Event</th>
            <th scope="col" class="px-6 py-4">Date</th>
            <th scope="col" class="px-6 py-4">Location</th>
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
            <td class="px-6 py-4">{{ event.date }}</td>
            <td class="px-6 py-4">{{ event.location }}</td>
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
          date: "2023-01-01",
          location: "Venue X",
        },
        {
          name: "Event B",
          date: "2023-02-02",
          location: "Venue Y",
        },
        {
          name: "Event C",
          date: "2023-03-03",
          location: "Venue Z",
        },
        {
          name: "Event D",
          date: "2023-04-04",
          location: "Venue W",
        },
        {
          name: "Event E",
          date: "2023-05-05",
          location: "Venue P",
        },
      ],
    };
  },
};
</script>
