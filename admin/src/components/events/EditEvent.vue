<template>
  <div class="container max-w-md mx-auto py-8 h-full">
    <div class="max-w-xl mx-auto bg-white rounded-lg overflow-hidden p-8">
      <h1 class="text-2xl font-semibold mb-4">Edit Event</h1>
      <form @submit.prevent="submitHandler">
        <!-- Event Title Field -->
        <div class="mb-4">
          <label for="title" class="block text-[#5a7184] font-semibold mb-2"
            >Event Title</label
          >
          <input
            type="text"
            id="title"
            v-model="formData.title"
            @input="clearError('title')"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
            :class="{
              'border-red-500': errors.title,
              'border-[#c3cad9]': !errors.title,
            }"
            placeholder="Enter event title"
          />
          <p v-if="errors.title" class="text-red-500 text-xs mt-1">
            {{ errors.title }}
          </p>
        </div>

        <!-- Location Field -->
        <div class="mb-4">
          <label for="location" class="block text-[#5a7184] font-semibold mb-2"
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

        <!-- Description Field -->
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

        <!-- Event Image Field -->
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
            accept="image/*"
          />
          <div class="flex items-center">
            <label for="image" class="cursor-pointer text-[#5a7184] py-2"
              >Upload Image</label
            >
            <span class="ml-2">{{ formData.image.name }}</span>
          </div>
          <img
            v-if="imagePreview"
            :src="imagePreview"
            alt="Image Preview"
            class="mt-2 rounded-md"
          />
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
            :config="{ format: 'Y-m-d H:i:s', enableTime: true }"
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
            :config="{ format: 'Y-m-d H:i:s', enableTime: true }"
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
          Edit Event
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { reactive, computed, onMounted } from "vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import axios from "axios";
import { setHeaders, url } from "../api";
import { useRouter, useRoute } from "vue-router";
import { formatDate } from "../../utils";
import { toast } from "vue3-toastify";

export default {
  setup() {
    const router = useRouter();
    const route = useRoute();
    const slug = route.params;

    const formData = reactive({
      title: "",
      location: "",
      description: "",
      image: "",
      start_date: formatDate(new Date()),
      end_date: formatDate(new Date()),
    });

    const errors = reactive({});
    const isLoading = false;

    const fetchEventDetails = async () => {
      try {
        const response = await axios.get(
          `${slug}/events/edit/${slug}`,
          setHeaders()
        );
        const event = response.data.event;
        console.log("event", response);
        formData.title = event.title;
        formData.location = event.location;
        formData.description = event.description;
        formData.start_date = formatDate(new Date(event.start_date));
        formData.end_date = formatDate(new Date(event.end_date));
        formData.image = event.image;
      } catch (error) {
        console.error("Error fetching event details:", error);
      }
    };

    onMounted(() => {
      fetchEventDetails();
    });

    const clearError = (field) => {
      if (errors[field]) {
        errors[field] = "";
      }
    };

    const isValid = () => {
      return true;
    };

    const submitHandler = async (event) => {
      event.preventDefault();

      if (!isValid()) {
        if (formData.title.trim() === "") {
          errors.title = "Event title is required";
        }
        if (formData.description.trim() === "") {
          errors.description = "Description is required";
        }
        if (formData.image.trim() === "") {
          errors.image = "Image / Flier is required";
        }
        const currentDateTime = new Date();

        if (formData.start_date.trim() === "") {
          errors.start_date = "Start date / time is required";
        } else {
          const startDate = new Date(formData.start_date);

          if (startDate <= currentDateTime) {
            errors.start_date = "Start date / time must be in the future";
          }
        }

        if (formData.end_date.trim() === "") {
          errors.end_date = "End date / time is required";
        } else {
          const endDate = new Date(formData.end_date);

          if (endDate <= currentDateTime) {
            errors.end_date = "End date / time must be in the future";
          }
        }

        return;
      }

      try {
        const data = new FormData();
        data.append("title", formData.title);
        data.append("location", formData.location);
        data.append("description", formData.description);
        if (formData.image instanceof File) {
          data.append("image", formData.image);
        }
        data.append("start_date", formData.start_date);
        data.append("end_date", formData.end_date);
        data.append("slug", formData.title);

        const response = await axios.put(
          `${url}/events/${slug}`,
          data,
          setHeaders()
        );
        await router.push("/event-management");
        toast.success("Event has been updated.", {
          position: "top-right",
          timeout: 3000,
        });
      } catch (error) {
        if (
          error.response &&
          error.response.data &&
          error.response.data.errors
        ) {
          errors.title = error.response.data.errors.title
            ? error.response.data.errors.title[0]
            : "";
          errors.location = error.response.data.errors.location
            ? error.response.data.errors.location[0]
            : "";
          errors.description = error.response.data.errors.description
            ? error.response.data.errors.description[0]
            : "";
          errors.image = error.response.data.errors.image
            ? error.response.data.errors.image[0]
            : "";
          errors.start_date = error.response.data.errors.start_date
            ? error.response.data.errors.start_date[0]
            : "";
          errors.end_date = error.response.data.errors.end_date
            ? error.response.data.errors.end_date[0]
            : "";
        }
      }
    };

    const handleImageUpload = (event) => {
      const file = event.target.files[0];

      if (!file) {
        formData.image = null;
        formData.imagePreview = null;
        return;
      }

      if (!file.type.startsWith("image/")) {
        clearError("image");
        errors.image = "Only image files (gifs, png, jpg, jpeg) are allowed.";
        return;
      }

      formData.image = file;
      clearError("image");
    };

    const imagePreview = computed(() => {
      if (formData.image instanceof File) {
        return URL.createObjectURL(formData.image);
      }
      return formData.image;
    });

    return {
      formData,
      errors,
      isLoading,
      clearError,
      isValid,
      submitHandler,
      VueDatePicker,
      handleImageUpload,
      imagePreview,
    };
  },
};
</script>

<style></style>
