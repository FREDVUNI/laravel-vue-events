<template>
  <div class="container max-w-md mx-auto py-8 h-full">
    <div class="max-w-xl mx-auto bg-white rounded-lg overflow-hidden p-8">
      <h1 class="text-2xl font-semibold mb-4">Register</h1>
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

        <!-- Role Field -->
        <div class="mb-4">
          <label for="role" class="block text-[#5a7184] font-semibold mb-2"
            >Role</label
          >
          <select
            v-model="formData.role"
            id="role"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
            :class="{
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
          Register
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

    const submitHandler = async(event) => {
      event.preventDefault();
      if (!isValid()) {
        if (formData.name.trim() === "") {
          errors.name = "Name is required";
        }
        if (formData.email.trim() === "") {
          errors.email = "Email is required";
        }
        if (formData.role.trim() === "") {
          errors.role = "Role is required";
        }
        if (formData.password.trim() === "") {
          errors.password = "Password is required";
        }
        return;
      }

      try {
        const response = await axios.post(
          `${import.meta.env.VITE_API_URL}auth/signup`,
          {
            name: formData.name,
            email: formData.email,
            password: formData.password,
            role: formData.role,
          }
        );

        router.push("/users");
      } catch (error) {
        // console.error(error.response.data);
        errors.name = error.response.data.errors.name[0];
        errors.email = error.response.data.errors.email[0];
        errors.password = error.response.data.errors.password[0];
        errors.role = error.response.data.errors.role[0];
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
