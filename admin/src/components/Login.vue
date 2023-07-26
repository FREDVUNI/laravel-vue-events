<template>
  <section class="container mx-auto px-5 py-10">
    <div class="w-full max-w-sm mx-auto">
      <h1 class="text-2xl font-bold text-center text-dark-hard mb-8">Login</h1>
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
        <p class="text-sm font-semibold text-[#5a7184]">
          Do not have an account?
          <router-link to="/register" class="text-primary ml-5">
            Register now
          </router-link>
        </p>
      </form>
    </div>
  </section>
</template>

<script>
import { reactive } from "vue";

export default {
  setup() {
    const formData = reactive({
      email: "",
      password: "",
    });

    const errors = reactive({});

    const isLoading = false; // Replace this with your loading state logic

    const clearError = (field) => {
      if (errors[field]) {
        errors[field] = "";
      }
    };

    const isValid = () => {
      // Replace this with your validation logic
      return true;
    };

    const submitHandler = (event) => {
      event.preventDefault();
      // Handle form submission logic here
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
