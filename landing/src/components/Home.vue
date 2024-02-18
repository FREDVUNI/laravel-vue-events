<template>
  <div class="bg-gray-100 min-h-screen">
    <nav
      :class="{
        'bg-transparent': !isScrolled && !mobileMenuOpen,
        'bg-white': isScrolled || mobileMenuOpen,
      }"
      class="fixed top-0 left-0 right-0 z-50 transition-colors duration-300 w-full"
    >
      <div
        id="header"
        :class="{ scrolled: isScrolled }"
        class="mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center py-4"
      >
        <a href="#" class="text-lg text-gray-900 md:text-gray-900"
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
        <ul
          :class="{ hidden: mobileMenuOpen }"
          class="md:flex space-x-4 hidden lg:flex"
        >
          <li>
            <a href="#" class="text-gray-600 hover:text-gray-800">Home</a>
          </li>
          <li>
            <a href="#about" class="text-gray-600 hover:text-gray-800">About</a>
          </li>
          <li>
            <a href="#events" class="text-gray-600 hover:text-gray-800"
              >Events</a
            >
          </li>
          <li>
            <a href="#contact" class="text-gray-600 hover:text-gray-800"
              >Contact</a
            >
          </li>
        </ul>
      </div>
      <div
        :class="{ block: mobileMenuOpen, hidden: !mobileMenuOpen }"
        class="md:hidden w-full"
      >
        <ul>
          <li>
            <a
              href="#"
              class="block px-4 py-2 text-gray-600 hover:text-gray-800"
              >Home</a
            >
          </li>
          <li>
            <a
              href="#about"
              class="block px-4 py-2 text-gray-600 hover:text-gray-800"
              >About</a
            >
          </li>
          <li>
            <a
              href="#events"
              class="block px-4 py-2 text-gray-600 hover:text-gray-800"
              >Events</a
            >
          </li>
          <li>
            <a
              href="#contact"
              class="block px-4 py-2 text-gray-600 hover:text-gray-800"
              >Contact</a
            >
          </li>
        </ul>
      </div>
    </nav>

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

    <section class="bg-white py-32" id="about">
      <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center"
      >
        <div class="w-full lg:w-1/2">
          <img
            src="/images/dance.png"
            alt="About Image"
            class="w-full rounded-lg"
          />
        </div>
        <div class="w-full lg:w-1/2 md:ml-5">
          <h2 class="text-3xl font-bold text-gray-800 mb-4 mt-5">About Us</h2>
          <p class="text-gray-600">
            We envision a world where every event, from intimate gatherings to
            large-scale conferences, is effortlessly organized, engaging, and
            successful. We aim to be the cornerstone of innovation in the events
            industry, redefining how events are planned, executed, and
            experienced.
          </p>
          <p class="text-gray-600">
            Benefits for You For Organizers: Simplify event planning, increase
            efficiency, and amplify audience engagement with our intuitive
            dashboard and customizable features. For Attendees: Enjoy a seamless
            registration process, personalized event recommendations, and
            interactive event experiences that keep you engaged and informed.
          </p>
          <p class="text-gray-600">
            Whether you're planning a corporate summit, a community festival, or
            a virtual meetup, we're here to support your vision. Let's
            collaborate to create memorable experiences that leave a lasting
            impact.
          </p>
        </div>
      </div>
    </section>
    <section id="features" class="py-32">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
              <i class="fas fa-calendar-alt mr-2"></i>
              Event Management
            </h2>
            <p class="text-gray-600">
              Effortlessly manage your events, from creating and organizing to
              promoting and ticketing.
            </p>
          </div>

          <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
              <i class="fas fa-map mr-2"></i>
              Discover Events
            </h2>
            <p class="text-gray-600">
              Explore a wide range of events happening in your area and discover
              new experiences.
            </p>
          </div>

          <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
              <i class="fas fa-user mr-2"></i>
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

    <section class="bg-gray-200 py-32" id="events">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-x-6 lg:grid-cols-3 lg:gap-x-12">
          <div
            class="mb-6 block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 lg:mb-0"
            data-te-ripple-init
            data-te-ripple-color="light"
          >
            <div class="relative overflow-hidden bg-cover bg-no-repeat">
              <img
                src="https://images.unsplash.com/photo-1527269534026-c86f4009eace?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1450&q=80"
                class="w-full rounded-t-lg"
                alt="event"
              />
              <a href="#!">
                <div
                  class="absolute top-0 right-0 bottom-0 left-0 h-full w-full bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100 bg-[hsla(0,0%,98.4%,0.2)]"
                ></div>
              </a>
              <svg
                class="absolute left-0 bottom-0 text-white dark:text-neutral-700"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1440 320"
              >
                <path
                  fill="currentColor"
                  d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
                ></path>
              </svg>
            </div>
            <div class="p-6">
              <h5 class="mb-4 text-lg font-bold">Nostalgic waves</h5>
              <p class="mb-6">
                Ut pretium ultricies dignissim. Sed sit amet mi eget urna
                placerat vulputate. Ut vulputate est non quam dignissim
                elementum. Donec a ullamcorper diam.
              </p>
            </div>
          </div>

          <div
            class="mb-6 block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 lg:mb-0"
          >
            <div
              class="relative overflow-hidden bg-cover bg-no-repeat"
              data-te-ripple-init
              data-te-ripple-color="light"
            >
              <img
                src="https://images.unsplash.com/photo-1549451371-64aa98a6f660?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80"
                alt="event"
                class="w-full rounded-t-lg"
              />
              <a href="#!">
                <div
                  class="absolute top-0 right-0 bottom-0 left-0 h-full w-full bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100 bg-[hsla(0,0%,98.4%,0.2)]"
                ></div>
              </a>
              <svg
                class="absolute left-0 bottom-0 text-white dark:text-neutral-700"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1440 320"
              >
                <path
                  fill="currentColor"
                  d="M0,96L48,128C96,160,192,224,288,240C384,256,480,224,576,213.3C672,203,768,213,864,202.7C960,192,1056,160,1152,128C1248,96,1344,64,1392,48L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
                ></path>
              </svg>
            </div>
            <div class="p-6">
              <h5 class="mb-4 text-lg font-bold">Winter wildlife</h5>
              <p class="mb-6">
                Suspendisse in volutpat massa. Nulla facilisi. Sed aliquet diam
                orci, nec ornare metus semper sed. Integer volutpat ornare erat
                sit amet rutrum.
              </p>
            </div>
          </div>

          <div
            class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700"
          >
            <div
              class="relative overflow-hidden bg-cover bg-no-repeat"
              data-te-ripple-init
              data-te-ripple-color="light"
            >
              <img
                src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80"
                class="w-full rounded-t-lg"
                alt="event"
              />
              <a href="#!">
                <div
                  class="absolute top-0 right-0 bottom-0 left-0 h-full w-full bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100 bg-[hsla(0,0%,98.4%,0.2)]"
                ></div>
              </a>
              <svg
                class="absolute left-0 bottom-0 text-white dark:text-neutral-700"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1440 320"
              >
                <path
                  fill="currentColor"
                  d="M0,288L48,256C96,224,192,160,288,160C384,160,480,224,576,213.3C672,203,768,117,864,85.3C960,53,1056,75,1152,69.3C1248,64,1344,32,1392,16L1440,0L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
                ></path>
              </svg>
            </div>
            <div class="p-6">
              <h5 class="mb-4 text-lg font-bold">Camping travel</h5>
              <p class="mb-6">
                Curabitur tristique, mi a mollis sagittis, metus felis mattis
                arcu, non vehicula nisl dui quis diam. Mauris ut risus eget
                massa volutpat feugiat.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="py-32">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-gray-800 text-center">
          Upcoming Events
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 mt-16">
          <div class="rounded-lg p-6 relative">
            <img
              src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80"
              alt="Conference 2023"
              class="w-full h-80 object-cover rounded-md"
            />
            <div
              class="absolute top-0 left-0 w-full h-full flex items-center justify-center text-white text-center"
            >
              <div>
                <h3 class="text-xl font-bold">Conference 2023</h3>
                <p class="mt-2">July 15-18, 2023</p>
                <a
                  href="#"
                  class="inline-block bg-black hover:bg-gray-700 text-white font-bold py-2 px-3 mt-4 rounded"
                  >Register Now</a
                >
              </div>
            </div>
          </div>
          <div class="rounded-lg p-6 relative">
            <img
              src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80"
              alt="Workshop Series"
              class="w-full h-80 object-cover rounded-md"
            />
            <div
              class="absolute top-0 left-0 w-full h-full flex items-center justify-center text-white text-center"
            >
              <div>
                <h3 class="text-xl font-bold">Workshop Series</h3>
                <p class="mt-2">August 5-7, 2023</p>
                <a
                  href="#"
                  class="inline-block bg-black hover:bg-gray-700 text-white font-bold py-2 px-3 mt-4 rounded"
                  >Register Now</a
                >
              </div>
            </div>
          </div>
          <div class="rounded-lg p-6 relative">
            <img
              src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80"
              alt="Networking Event"
              class="w-full h-80 object-cover rounded-md"
            />
            <div
              class="absolute top-0 left-0 w-full h-full flex items-center justify-center text-white text-center"
            >
              <div>
                <h3 class="text-xl font-bold">Networking Event</h3>
                <p class="mt-2">September 10, 2023</p>
                <a
                  href="#"
                  class="inline-block bg-black hover:bg-gray-700 text-white font-bold py-2 px-3 mt-4 rounded"
                  >Register Now</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-white py-32" id="contact">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Contact Us</h2>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-16">
            <div>
              <h3 class="text-xl font-bold text-gray-800">Events Management</h3>
              <p class="mt-4 text-gray-600">123 Main Street, Cityville, USA</p>
              <p class="mt-2 text-gray-600">Phone: 123-456-7890</p>
              <p class="mt-2 text-gray-600">
                Email: eventsmanagement@gmail.com
              </p>

              <div class="flex justify-left space-x-8 py-5">
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

            <div>
              <form class="flex flex-col">
                <label for="name" class="text-gray-800 font-bold">Name</label>
                <input
                  type="text"
                  id="name"
                  class="border border-gray-300 rounded-lg py-2 px-4 mt-2 focus:border-gray-500 focus:outline-none"
                  placeholder="Enter name"
                  required
                />
                <label for="email" class="text-gray-800 font-bold mt-4"
                  >Email</label
                >
                <input
                  type="email"
                  id="email"
                  class="border border-gray-300 rounded-lg py-2 px-4 mt-2 focus:border-gray-500 focus:outline-none"
                  placeholder="Enter email address"
                  required
                />
                <label for="message" class="text-gray-800 font-bold mt-4"
                  >Message</label
                >
                <textarea
                  id="message"
                  rows="4"
                  class="border border-gray-300 rounded-lg py-2 px-4 mt-2 focus:border-gray-500 focus:outline-none"
                  placeholder="Enter message"
                  required
                ></textarea>
                <button
                  type="submit"
                  class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 mt-8 rounded"
                >
                  Submit
                </button>
              </form>
            </div>
          </div>
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
      isScrolled: false,
    };
  },
  mounted() {
    window.addEventListener("scroll", this.handleScroll);
  },
  beforeDestroy() {
    window.removeEventListener("scroll", this.handleScroll);
  },
  methods: {
    handleScroll() {
      this.isScrolled = window.scrollY > 0;
    },
    toggleMobileMenu() {
      this.mobileMenuOpen = !this.mobileMenuOpen;
    },
  },
};
</script>

<style scoped>
#header {
  background-color: transparent;
  transition: background-color 0.3s;
  position: sticky;
}

#header.scrolled {
  background-color: white;
  /* width: 100%; */
}

#header a {
  color: white;
}

#header.scrolled a {
  color: gray;
}

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
    url("https://images.unsplash.com/photo-1603228254119-e6a4d095dc59?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80");
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
