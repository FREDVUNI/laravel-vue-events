<template>
  <section class="container mx-auto py-8">
    <div class="max-w-4xl mx-auto">
      <h1 class="text-2xl font-semibold mb-4">Add Event</h1>
      <form @submit="submitHandler">
        <div class="flex flex-col mb-6 w-full">
          <label for="event" class="text-[#5a7184] font-semibold block">
            Event
          </label>
          <input
            type="text"
            id="event"
            v-model="formData.event"
            @input="clearError('event')"
            :class="{
              'placeholder:text-[#959ead]': true,
              'text-dark-hard': true,
              'mt-3': true,
              'rounded-lg': true,
              'px-5': true,
              'py-4': true,
              'font-semibold': true,
              block: true,
              'outline-none': true,
              border: true,
              'border-red-500': errors.event,
              'border-[#c3cad9]': !errors.event,
            }"
            placeholder="Enter event"
          />
          <p v-if="errors.event" class="text-red-500 text-xs mt-1">
            {{ errors.event }}
          </p>
        </div>
        <div class="flex flex-col mb-6 w-full">
          <label for="location" class="text-[#5a7184] font-semibold block">
            Location
          </label>
          <input
            type="text"
            id="location"
            v-model="formData.location"
            @input="clearError('location')"
            :class="{
              'placeholder:text-[#959ead]': true,
              'text-dark-hard': true,
              'mt-3': true,
              'rounded-lg': true,
              'px-5': true,
              'py-4': true,
              'font-semibold': true,
              block: true,
              'outline-none': true,
              border: true,
              'border-red-500': errors.location,
              'border-[#c3cad9]': !errors.location,
            }"
            placeholder="Enter location"
          />
          <p v-if="errors.location" class="text-red-500 text-xs mt-1">
            {{ errors.location }}
          </p>
        </div>
        <div class="w-full md:w-1/2">
          <button
            type="submit"
            :disabled="!isValid || isLoading"
            class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold text-lg py-4 px-8 rounded-lg my-6 disabled:opacity-70 disabled:cursor-not-allowed"
          >
            Register
          </button>
        </div>
      </form>
    </div>
  </section>
</template>

<script>
import { reactive } from "vue";

export default {
  setup() {
    const formData = reactive({
      event: "",
      location: "",
    });

    const errors = reactive({});

    const isLoading = false;

    const clearError = (field) => {
      if (errors[field]) {
        errors[field] = "";
      }
    };

    const isValid = () => {
      return true;
    };

    const submitHandler = (event) => {
      event.preventDefault();
    };

    return {
      formData,
      errors,
      isLoading,
      clearError,
      isValid,
      submitHandler,
    };
  },
};
</script>
