<template>
  <section class="container mx-auto px-5 py-10">
    <div class="w-full max-w-sm mx-auto">
      <h1 class="text-4xl font-bold text-center text-dark-hard mb-8">Login</h1>
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
              'border-red-500': errors.email,
              'border-[#c3cad9]': !errors.email,
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
              'border-red-500': errors.password,
              'border-[#c3cad9]': !errors.password,
            }"
            placeholder="Enter password"
          />
          <p v-if="errors.password" class="text-red-500 text-xs mt-1">
            {{ errors.password }}
          </p>
        </div>
        <router-link
          to="/forget-password"
          class="text-sm font-semibold text-primary"
        >
          Forgot password?
        </router-link>
        <button
          type="submit"
          :disabled="!isValid || isLoading"
          class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold text-lg py-4 px-8 w-full rounded-lg my-6 disabled:opacity-70 disabled:cursor-not-allowed"
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

export default {
  setup() {
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
          "http://127.0.0.1:8000/api/auth/signin",
          {
            email: formData.email,
            password: formData.password,
          }
        );

        console.log(response.data);
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
