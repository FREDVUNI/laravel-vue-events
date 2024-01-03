<template>
  <div class="container mx-auto py-8">
    <div class="max-w-4xl mx-auto">
      <div class="bg-white rounded-lg overflow-hidden">
        <h1 class="text-2xl font-semibold mb-4 px-4">Register</h1>
        <form @submit.prevent="submitHandler">
          <div class="flex flex-wrap -mx-4">
            <div class="w-full md:w-1/2 px-4">
              <div class="p-4">
                <label for="name" class="text-[#5a7184] font-semibold block"
                  >Name</label
                >
                <input
                  type="name"
                  id="name"
                  v-model="formData.name"
                  @input="clearError('name')"
                  class="w-full px-3 py-2"
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
            </div>
            <div class="w-full md:w-1/2 px-4">
              <div class="p-4">
                <label for="email" class="text-[#5a7184] font-semibold block"
                  >Email</label
                >
                <input
                  type="email"
                  id="email"
                  v-model="formData.email"
                  @input="clearError('email')"
                  class="w-full px-3 py-2"
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
            </div>
            <div class="w-full md:w-1/2 px-4">
              <div class="p-4">
                <label for="password" class="text-[#5a7184] font-semibold block"
                  >Password</label
                >
                <input
                  type="password"
                  id="password"
                  v-model="formData.password"
                  @input="clearError('password')"
                  class="w-full px-3 py-2"
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
            </div>
            <div class="w-full md:w-1/2 px-4">
              <div class="p-4">
                <label for="role" class="text-[#5a7184] font-semibold block"
                  >Role</label
                >
                <select
                  v-model="formData.role"
                  id="role"
                  class="w-full px-3 py-2"
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
            </div>
          </div>
          <div class="w-full md:w-1/2 px-4">
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
    </div>
  </div>
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
