<template>
  <div class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow fixed top-0 left-0 right-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
          <a href="#" class="text-xl font-bold text-gray-800"
            >Events Management</a
          >
          <button
            @click="toggleMobileMenu"
            class="md:hidden text-gray-600 hover:text-gray-800 focus:outline-none"
          >
            <svg
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                :class="{
                  hidden: mobileMenuOpen,
                  'inline-flex': !mobileMenuOpen,
                }"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              ></path>
              <path
                :class="{
                  hidden: !mobileMenuOpen,
                  'inline-flex': mobileMenuOpen,
                }"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              ></path>
            </svg>
          </button>
          <!-- Navigation links -->
          <ul :class="{ hidden: mobileMenuOpen }" class="md:flex space-x-4">
            <li>
              <a href="#" class="text-gray-600 hover:text-gray-800">Home</a>
            </li>
            <li>
              <a href="#" class="text-gray-600 hover:text-gray-800">About</a>
            </li>
            <li>
              <a href="#" class="text-gray-600 hover:text-gray-800">Events</a>
            </li>
            <li>
              <a href="#" class="text-gray-600 hover:text-gray-800">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div
      :class="{ block: mobileMenuOpen, hidden: !mobileMenuOpen }"
      class="md:hidden bg-white"
    >
      <ul class="py-4">
        <li>
          <a href="#" class="block px-4 py-2 text-gray-600 hover:text-gray-800"
            >Home</a
          >
        </li>
        <li>
          <a href="#" class="block px-4 py-2 text-gray-600 hover:text-gray-800"
            >About</a
          >
        </li>
        <li>
          <a href="#" class="block px-4 py-2 text-gray-600 hover:text-gray-800"
            >Events</a
          >
        </li>
        <li>
          <a href="#" class="block px-4 py-2 text-gray-600 hover:text-gray-800"
            >Contact</a
          >
        </li>
      </ul>
    </div>

    <section id="hero" class="text-center py-80">
      <h1 class="text-4xl font-bold text-gray-800">
        Welcome to our Events Management
      </h1>
      <p class="mt-4 text-gray-600">We organize amazing events for you!</p>
      <a
        href="#about"
        class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 mt-8 rounded"
        >Learn More</a
      >
    </section>

    <section class="bg-white py-32">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center">
        <div class="w-1/2">
          <img
            src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80"
            alt="About Image"
            class="w-full rounded-lg"
          />
        </div>
        <div class="w-1/2 pl-8">
          <h2 class="text-3xl font-bold text-gray-800 mb-4">About Us</h2>
          <p class="text-gray-600">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla
            fringilla enim ac nulla bibendum, id ullamcorper lorem cursus.
            Phasellus scelerisque aliquet nisl, at pellentesque tellus mattis
            et. Sed sollicitudin justo sed risus feugiat, in eleifend eros
            dignissim. Mauris auctor ante vitae purus mollis pulvinar. In hac
            habitasse platea dictumst.
          </p>
        </div>
      </div>
    </section>
    <section id="features" class="py-32">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
              Event Management
            </h2>
            <p class="text-gray-600">
              Effortlessly manage your events, from creating and organizing to
              promoting and ticketing.
            </p>
          </div>

          <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
              Discover Events
            </h2>
            <p class="text-gray-600">
              Explore a wide range of events happening in your area and discover
              new experiences.
            </p>
          </div>

          <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
              Attendee Management
            </h2>
            <p class="text-gray-600">
              Keep track of attendees, send notifications, and manage
              registrations effortlessly.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-gray-200 py-32">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <div class="bg-white rounded-lg shadow p-6">
            <img
              src="https://cdn-ajggd.nitrocdn.com/kMoOFpDlsOVtlYJLrnSRNCQXaUFHZPTY/assets/images/optimized/rev-814242f/wp-content/uploads/bb-plugin/cache/event-photography-feat-landscape-b5ebb4965b6271ddb206a62fffa41bde-zybravgx2q47.jpg"
              alt="Event Image"
              class="w-full mb-4"
            />
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Event Title</h2>
            <p class="text-gray-600">
              Event description goes here. Lorem ipsum dolor sit amet,
              consectetur adipiscing elit.
            </p>
          </div>

          <div class="bg-white rounded-lg shadow p-6">
            <img
              src="https://images.unsplash.com/photo-1549451371-64aa98a6f660?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80"
              alt="Event Image"
              class="w-full mb-4"
            />
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Event Title</h2>
            <p class="text-gray-600">
              Event description goes here. Lorem ipsum dolor sit amet,
              consectetur adipiscing elit.
            </p>
          </div>

          <div class="bg-white rounded-lg shadow p-6">
            <img
              src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80"
              alt="Event Image"
              class="w-full mb-4"
            />
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Event Title</h2>
            <p class="text-gray-600">
              Event description goes here. Lorem ipsum dolor sit amet,
              consectetur adipiscing elit.
            </p>
          </div>
        </div>
      </div>
    </section>
    <section class="bg-white py-32">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Contact Us</h2>
        <div class="flex justify-center space-x-8">
          <a href="#" class="text-4xl text-gray-600 hover:text-gray-800">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="text-4xl text-gray-600 hover:text-gray-800">
            <i class="fab fa-facebook"></i>
          </a>
          <a href="#" class="text-4xl text-gray-600 hover:text-gray-800">
            <i class="fab fa-instagram"></i>
          </a>
        </div>
      </div>
    </section>

    <footer class="bg-gray-800 py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-gray-400">
          &copy; {{ new Date().getFullYear() }} Events Management. All rights
          reserved.
        </p>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: "EventsManagement",
  data() {
    return {
      mobileMenuOpen: false,
    };
  },
  methods: {
    toggleMobileMenu() {
      this.mobileMenuOpen = !this.mobileMenuOpen;
    },
  },
};
</script>

<style scoped>
.nav-link {
  color: white;
  padding: 0.5rem 1rem;
  transition: background-color 0.3s ease;
}

.nav-link:hover {
  background-color: rgba(255, 255, 255, 0.1);
}
#hero {
  background-image: linear-gradient(
      rgba(27, 32, 51, 0.6),
      rgba(27, 32, 51, 0.6)
    ),
    url("https://cdn-ajggd.nitrocdn.com/kMoOFpDlsOVtlYJLrnSRNCQXaUFHZPTY/assets/images/optimized/rev-814242f/wp-content/uploads/bb-plugin/cache/event-photography-feat-landscape-b5ebb4965b6271ddb206a62fffa41bde-zybravgx2q47.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 800px;
}
#hero h1 {
  color: #ffffff;
  font-size: 45px;
}

#hero p {
  color: #ffffff;
  font-size: 25px;
}

#hero a {
  background-color: #ffffff;
  color: #1b2033;
}

#hero a:hover {
  background-color: #e5e7eb;
  color: #1b2033;
}
@media (min-width: 768px) {
  .nav-link {
    padding: 0.5rem 1.5rem;
  }
}
</style>
