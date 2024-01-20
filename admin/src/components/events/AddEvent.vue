<template>
  <div class="container max-w-md mx-auto py-8 h-full">
    <div class="max-w-xl mx-auto bg-white rounded-lg overflow-hidden p-8">
      <h1 class="text-2xl font-semibold mb-4">Add Event</h1>
      <form @submit.prevent="submitHandler">
        <!-- Event Field -->
        <div class="mb-4">
          <label for="event" class="block text-[#5a7184] font-semibold mb-2"
            >Event</label
          >
          <input
            type="text"
            id="event"
            v-model="formData.event"
            @input="clearError('event')"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
            :class="{
              'border-red-500': errors.event,
              'border-[#c3cad9]': !errors.event,
            }"
            placeholder="Enter event"
          />
          <p v-if="errors.event" class="text-red-500 text-xs mt-1">
            {{ errors.event }}
          </p>
        </div>

        <!-- Location Field -->
        <div class="mb-4">
          <label for="loaction" class="block text-[#5a7184] font-semibold mb-2"
            >Location</label
          >
          <input
            type="text"
            id="location"
            v-model="formData.location"
            @input="clearError('location')"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
            :class="{
              'border-red-500': errors.location,
              'border-[#c3cad9]': !errors.location,
            }"
            placeholder="Enter location"
          />
          <p v-if="errors.location" class="text-red-500 text-xs mt-1">
            {{ errors.location }}
          </p>
        </div>

        <button
          type="submit"
          :disabled="!isValid || isLoading"
          class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold text-lg py-2 px-4 rounded-lg disabled:opacity-70 disabled:cursor-not-allowed"
        >
          create event
        </button>
      </form>
    </div>
  </div>
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
