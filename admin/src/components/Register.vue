<template>
  <section class="container mx-auto px-5 py-10">
    <div class="w-full max-w-sm mx-auto">
      <h1 class="text-2xl font-semibold mb-4">Admin Registration</h1>
      <form @submit="submitHandler">
        <div class="flex flex-col mb-6 w-full">
          <label for="name" class="text-[#5a7184] font-semibold block">
            Name
          </label>
          <input
            type="name"
            id="name"
            v-model="formData.name"
            @input="clearError('name')"
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
              'border-red-500': errors.name,
              'border-[#c3cad9]': !errors.name,
            }"
            placeholder="Enter name"
          />
          <p v-if="errors.name" class="text-red-500 text-xs mt-1">
            {{ errors.name }}
          </p>
        </div>
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
        <div class="flex flex-col mb-6 w-full">
          <label for="role" class="text-[#5a7184] font-semibold block"
            >Role</label
          >
          <select
            v-model="formData.role"
            id="role"
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
              'border-red-500': errors.role,
              'border-[#c3cad9]': !errors.role,
            }"
          >
            <option value="" disabled>Select a role</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
          </select>
          <p v-if="errors.role" class="text-red-500 text-xs mt-1">
            {{ errors.role }}
          </p>
        </div>
        <button
          type="submit"
          :disabled="!isValid || isLoading"
          class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold text-lg py-4 px-8 w-full rounded-lg my-6 disabled:opacity-70 disabled:cursor-not-allowed"
        >
          Register
        </button>
      </form>
    </div>
  </section>
</template>

<script>
import { reactive } from "vue";

export default {
  setup() {
    const formData = reactive({
      name: "",
      email: "",
      password: "",
      role: "",
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
