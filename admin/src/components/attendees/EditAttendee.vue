<template>
  <div class="container max-w-md mx-auto py-8 h-full">
    <div class="max-w-xl mx-auto bg-white rounded-lg overflow-hidden p-8">
      <h1 class="text-2xl font-semibold mb-4">Add Attendee</h1>
      <form @submit.prevent="submitHandler">
        <!-- Name Field -->
        <div class="mb-4">
          <label for="name" class="block text-[#5a7184] font-semibold mb-2"
            >Name</label
          >
          <input
            type="name"
            id="name"
            v-model="formData.name"
            @input="clearError('name')"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
            :class="{
              'border-red-500': errors.name,
              'border-[#c3cad9]': !errors.name,
            }"
            placeholder="Enter name"
          />
          <p v-if="errors.name" class="text-red-500 text-xs mt-1">
            {{ errors.name }}
          </p>
        </div>

        <!-- Email Field -->
        <div class="mb-4">
          <label for="email" class="block text-[#5a7184] font-semibold mb-2"
            >Email</label
          >
          <input
            type="email"
            id="email"
            v-model="formData.email"
            @input="clearError('email')"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
            :class="{
              'border-red-500': errors.email,
              'border-[#c3cad9]': !errors.email,
            }"
            placeholder="Enter email"
          />
          <p v-if="errors.email" class="text-red-500 text-xs mt-1">
            {{ errors.email }}
          </p>
        </div>

        <!-- Phone Field -->
        <div class="mb-4">
          <label for="phone" class="block text-[#5a7184] font-semibold mb-2"
            >Phone</label
          >
          <input
            type="tel"
            id="phone"
            v-model="formData.phone"
            @input="clearError('phone')"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
            :class="{
              'border-red-500': errors.phone,
              'border-[#c3cad9]': !errors.phone,
            }"
            placeholder="Enter phone"
          />
          <p v-if="errors.phone" class="text-red-500 text-xs mt-1">
            {{ errors.phone }}
          </p>
        </div>

        <button
          type="submit"
          :disabled="!isValid || isLoading"
          class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold text-lg py-2 px-4 rounded-lg disabled:opacity-70 disabled:cursor-not-allowed"
        >
          Add attendee
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { reactive } from "vue";
import axios from "axios";

export default {
  setup() {
    const formData = reactive({
      name: "",
      email: "",
      phone: "",
    });

    const errors = reactive({});

    const isLoading = false;

    const clearError = (field) => {
      if (errors[field]) {
        errors[field] = "";
      }
    };

    const isValid = () => {
      return (
        formData.name.trim() !== "" &&
        formData.email.trim() !== "" &&
        formData.phone.trim() !== ""
      );
    };

    const submitHandler = async (event) => {
      event.preventDefault();

      if (!isValid()) {
        if (formData.name.trim() === "") {
          errors.name = "Name is required";
        }
        if (formData.email.trim() === "") {
          errors.email = "Email is required";
        }
        if (formData.phone.trim() === "") {
          errors.phone = "Phone is required";
        }
        return;
      }

      // Make API call to update profile
      try {
        const response = await axios.patch(
          `${import.meta.env.VITE_API_URL}/profile/update`,
          {
            name: formData.name,
            email: formData.email,
            phone: formData.phone,
          }
        );

        // Handle successful response
        console.log(response.data);
      } catch (error) {
        // Handle error
        console.error(error.response.data);
        // Set errors based on API response
        errors.name = error.response.data.errors.name;
        errors.email = error.response.data.errors.email;
        errors.phone = error.response.data.errors.phone;
      }
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
