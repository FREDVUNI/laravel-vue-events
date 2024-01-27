<template>
  <div class="container max-w-md mx-auto py-8 h-full">
    <div class="max-w-xl mx-auto bg-white rounded-lg overflow-hidden p-8">
      <h1 class="text-2xl font-semibold mb-4">Add Event</h1>
      <form @submit.prevent="submitHandler">
        <div class="mb-4">
          <label for="event" class="block text-[#5a7184] font-semibold mb-2"
            >Event</label
          >
          <input
            type="text"
            id="event"
            v-model="formData.title"
            @input="clearError('event')"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
            :class="{
              'border-red-500': errors.event,
              'border-[#c3cad9]': !errors.event,
            }"
            placeholder="Enter event title"
          />
          <p v-if="errors.event" class="text-red-500 text-xs mt-1">
            {{ errors.event }}
          </p>
        </div>

        <div class="mb-4">
          <label
            for="description"
            class="block text-[#5a7184] font-semibold mb-2"
            >Description</label
          >
          <textarea
            id="description"
            v-model="formData.description"
            @input="clearError('description')"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
            :class="{
              'border-red-500': errors.description,
              'border-[#c3cad9]': !errors.description,
            }"
            placeholder="Enter event description"
          ></textarea>
          <p v-if="errors.description" class="text-red-500 text-xs mt-1">
            {{ errors.description }}
          </p>
        </div>

        <div class="mb-4">
          <label for="image" class="block text-[#5a7184] font-semibold mb-2"
            >Event Image</label
          >
          <input
            type="file"
            id="image"
            ref="imageInput"
            @change="handleImageUpload"
            class="hidden"
          />
          <div class="flex items-center">
            <label for="image" class="cursor-pointer text-[#5a7184] py-2">
              Upload Image
            </label>
            <span class="ml-2">{{ formData.image.name }}</span>
          </div>
          <p v-if="errors.image" class="text-red-500 text-xs mt-1">
            {{ errors.image }}
          </p>
        </div>

        <!-- Start Date Field with VueDatePicker -->
        <div class="mb-4">
          <label
            for="start_date"
            class="block text-[#5a7184] font-semibold mb-2"
            >Start Date</label
          >
          <VueDatePicker
            v-model="formData.start_date"
            @input="clearError('start_date')"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
          />
          <p v-if="errors.start_date" class="text-red-500 text-xs mt-1">
            {{ errors.start_date }}
          </p>
        </div>

        <!-- End Date Field with VueDatePicker -->
        <div class="mb-4">
          <label for="end_date" class="block text-[#5a7184] font-semibold mb-2"
            >End Date</label
          >
          <VueDatePicker
            v-model="formData.end_date"
            @input="clearError('end_date')"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
          />
          <p v-if="errors.end_date" class="text-red-500 text-xs mt-1">
            {{ errors.end_date }}
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
import VueDatePicker from "@vuepic/vue-datepicker";

export default {
  setup() {
    const formData = reactive({
      title: "",
      description: "",
      image: "",
      start_date: null,
      end_date: null,
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

    const handleImageUpload = (event) => {
      const file = event.target.files[0];
      formData.image = file;
      clearError("image");
    };

    return {
      formData,
      errors,
      isLoading,
      clearError,
      isValid,
      submitHandler,
      VueDatePicker,
      handleImageUpload,
    };
  },
};
</script>

<style></style>
