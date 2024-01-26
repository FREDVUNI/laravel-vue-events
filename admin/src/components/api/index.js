import { computed } from "vue";
import { useAuthStore } from "../../stores/authStore";

export const url = `${import.meta.env.VITE_API_URL}`;

export const setHeaders = () => {
  const token = computed(() => useAuthStore().token);

  const header = {
    headers: {
      Authorization: `Bearer ${token.value || localStorage.getItem("token")}`,
    },
  };

  return header;
};
