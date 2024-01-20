<template>
  <section class="container mx-auto px-5 py-12">
    <div
      class="max-w-sm mx-auto bg-white rounded-lg overflow-hidden p-8 shadow-lg"
    >
      <h1 class="text-2xl font-bold text-center mb-8">Sign in</h1>
      <form @submit="submitHandler">
        <div class="flex flex-col mb-6 w-full">
          <label for="email" class="text-[#5a7184] font-semibold block">
            Email
          </label>
          <input
            type="email"
            id="email"
            v-model="formData.email"
            @input="clearError('email')"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
            :class="{
              'border-red-500': errors.event,
              'border-[#c3cad9]': !errors.event,
            }"
            placeholder="Enter email"
          />
          <p v-if="errors.email" class="text-red-500 text-xs mt-1">
            {{ errors.email }}
          </p>
        </div>
        <div class="flex flex-col mb-6 w-full">
          <label for="password" class="text-[#5a7184] font-semibold block">
            Password
          </label>
          <input
            type="password"
            id="password"
            v-model="formData.password"
            @input="clearError('password')"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
            :class="{
              'border-red-500': errors.event,
              'border-[#c3cad9]': !errors.event,
            }"
            placeholder="Enter password"
          />
          <p v-if="errors.password" class="text-red-500 text-xs mt-1">
            {{ errors.password }}
          </p>
        </div>
        <router-link to="/forgot-password" class="text-sm text-primary">
          Forgot password?
        </router-link>
        <button
          type="submit"
          :disabled="!isValid || isLoading"
          class="w-full bg-indigo-500 hover:bg-indigo-600 mt-5 text-white font-bold text-lg py-2 px-4 rounded-lg disabled:opacity-70 disabled:cursor-not-allowed"
        >
          Sign In
        </button>
      </form>
    </div>
  </section>
</template>

<script>
import { reactive } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/authStore";

export default {
  setup() {
    const router = useRouter();
    const authStore = useAuthStore();

    const formData = reactive({
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
      return formData.email.trim() !== "" && formData.password.trim() !== "";
    };

    const submitHandler = async (event) => {
      event.preventDefault();
      if (!isValid()) {
        if (formData.email.trim() === "") {
          errors.email = "Email is required";
        }
        if (formData.password.trim() === "") {
          errors.password = "Password is required";
        }
        return;
      }

      try {
        const response = await axios.post(
          `${import.meta.env.VITE_API_URL}auth/signin`,
          {
            email: formData.email,
            password: formData.password,
          }
        );

        // console.log(response.data);
        authStore.setAuthenticated(true);
        router.push("/");
      } catch (error) {
        console.error(error.response.data);
        console.error(error.response.data);
        errors.email = error.response.data.errors.email[0];
        errors.password = error.response.data.errors.password[0];
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
