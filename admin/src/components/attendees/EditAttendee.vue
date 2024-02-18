<template>
  <div class="container max-w-md mx-auto py-8 h-full">
    <div class="max-w-xl mx-auto bg-white rounded-lg overflow-hidden p-8">
      <h1 class="text-2xl font-semibold mb-4">Edit Attendee</h1>
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
        <!-- slug field -->
        <input type="hidden" name="slug" id="slug" v-model="formData.slug" />
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
          Update attendee
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { reactive, onMounted } from "vue";
import axios from "axios";
import { setHeaders, url } from "../api";
import { useRouter } from "vue-router";
import { toast } from "vue3-toastify";

export default {
  setup() {
    const router = useRouter();
    const formData = reactive({
      name: "",
      email: "",
      phone: "",
      slug: "",
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
        formData.phone.trim() !== "" &&
        formData.slug.trim() !== ""
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
        if (formData.slug.trim() === "") {
          errors.slug = "Slug is required";
        }
        return;
      }

      try {
        const slugValue = router.currentRoute.value.params.slug;
        const response = await axios.patch(
          `${url}/attendees/update/${slugValue}`,
          {
            name: formData.name,
            email: formData.email,
            phone: formData.phone,
            slug: formData.slug,
          },
          setHeaders()
        );
        await router.push("/attendee-management");
        toast.success("Attendee has been updated.", {
          position: "top-right",
          timeout: 3000,
        });
      } catch (error) {
        console.error(error);
      }
    };

    const fetchAttendeeData = async () => {
      try {
        const slugValue = router.currentRoute.value.params.slug;
        const response = await axios.get(
          `${url}/attendees/edit/${slugValue}`,
          setHeaders()
        );
        const { name, email, phone, slug } = response.data.attendee;
        formData.name = name;
        formData.email = email;
        formData.phone = phone;
        formData.slug = slugValue;
        console.log(response);
      } catch (error) {
        console.error(error);
      }
    };

    onMounted(() => {
      fetchAttendeeData();
    });

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
