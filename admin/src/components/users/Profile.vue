<template>
  <div class="container max-w-md mx-auto py-8 h-full">
    <div class="max-w-xl mx-auto bg-white rounded-lg overflow-hidden p-8">
      <h1 class="text-2xl font-semibold mb-4">Profile</h1>
      <div class="mb-8">
        <div class="relative w-20 h-20 rounded-full bg-gray-200 mb-4">
          <img
            src="https://www.f6s.com/content-resource/profiles/3610847_th2.jpg"
            alt="profile"
            class="rounded-full bg-gray-200"
          />
        </div>
        <button
          type="button"
          @click="handleDeleteImage"
          class="text-red-500 font-semibold"
        >
          Delete
        </button>
      </div>

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

        <!-- Password Field -->
        <div class="mb-4">
          <label for="password" class="block text-[#5a7184] font-semibold mb-2"
            >Password</label
          >
          <input
            type="password"
            id="password"
            v-model="formData.password"
            @input="clearError('password')"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
            :class="{
              'border-red-500': errors.password,
              'border-[#c3cad9]': !errors.password,
            }"
            placeholder="Enter password"
          />
          <p v-if="errors.password" class="text-red-500 text-xs mt-1">
            {{ errors.password }}
          </p>
        </div>

        <button
          type="submit"
          :disabled="!isValid || isLoading"
          class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold text-lg py-2 px-4 rounded-lg disabled:opacity-70 disabled:cursor-not-allowed"
        >
          Update Profile
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
      password: "",
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
        formData.password.trim() !== ""
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
        if (formData.password.trim() === "") {
          errors.password = "Password is required";
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
            password: formData.password,
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
        errors.password = error.response.data.errors.password;
      }
    };

    const handleDeleteImage = async () => {
      // Make API call to delete image
      try {
        const response = await axios.delete("/api/profile/delete-image");

        // Handle successful response
        console.log(response.data);
      } catch (error) {
        // Handle error
        console.error(error.response.data);
      }
    };
    const fetchUserData = async () => {
      try {
        const response = await axios.get("/api/user");

        // Update user data with the response
        user.id = response.data.id;
        user.name = response.data.name;
        user.email = response.data.email;
      } catch (error) {
        console.error(error.response.data);
      }
    };

    return {
      formData,
      errors,
      isLoading,
      clearError,
      isValid,
      submitHandler,
      handleDeleteImage,
      fetchUserData,
    };
  },
};
</script>
