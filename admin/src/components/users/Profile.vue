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

        <!-- Role Field -->
        <div class="mb-4">
          <label
            for="currentRole"
            class="block text-[#5a7184] font-semibold mb-2"
            >Current Role</label
          >
          <p>{{ formData.role }}</p>
        </div>
        <div class="mb-4">
          <label for="role" class="block text-[#5a7184] font-semibold mb-2"
            >Role</label
          >
          <select
            id="role"
            class="w-full px-4 py-2 rounded-lg border placeholder-[#959ead] text-dark-hard"
            :class="{
              'border-red-500': errors.role,
              'border-[#c3cad9]': !errors.role,
            }"
          >
            <option value>Change role</option>
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
          Update Profile
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { reactive, onMounted } from "vue";
import axios from "axios";
import { useAuthStore } from "../../stores/authStore";
import { useRouter } from "vue-router";
import { toast } from "vue3-toastify";

export default {
  setup() {
    const token = useAuthStore().token;
    const router = useRouter();
    const formData = reactive({
      id: "",
      name: "",
      email: "",
      role: "",
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
        formData.password.trim() !== "" &&
        formData.role.trim() !== ""
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
        if (formData.role.trim() === "") {
          errors.role = "Role is required";
        }
        if (formData.password.trim() === "") {
          errors.password = "Password is required";
        }
        return;
      }
      try {
        const id = formData.id;
        const response = await axios.patch(
          `${import.meta.env.VITE_API_URL}users/update/${id}`,
          {
            name: formData.name,
            email: formData.email,
            password: formData.password,
            role: formData.role,
          },
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        await router.push("/users");
        toast.success("profile has been updated.", {
          position: "top-right",
          timeout: 3000,
        });
      } catch (error) {
        if (
          error.response &&
          error.response.data &&
          error.response.data.errors
        ) {
          errors.name = error.response.data.errors.name
            ? error.response.data.errors.name[0]
            : "";
          errors.email = error.response.data.errors.email
            ? error.response.data.errors.email[0]
            : "";
          errors.role = error.response.data.errors.role
            ? error.response.data.errors.role[0]
            : "";
          errors.password = error.response.data.errors.password
            ? error.response.data.errors.password[0]
            : "";
        }
      }
    };

    const handleDeleteImage = async () => {
      try {
        const response = await axios.delete(
          `${import.meta.env.VITE_API_URL}auth/profile/delete-image`,
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        console.log(response.data);
      } catch (error) {
        console.error(error.response.data);
      }
    };

    const fetchUserData = async () => {
      try {
        const response = await axios.get(
          `${import.meta.env.VITE_API_URL}auth/user`,
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        formData.id = response.data.id;
        formData.name = response.data.name;
        formData.email = response.data.email;
        formData.role = response.data.role;
        formData.password = "";
      } catch (error) {
        console.error(error.response.data);
      }
    };

    onMounted(() => {
      fetchUserData();
    });

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
