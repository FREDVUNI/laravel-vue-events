import { computed } from "vue";
import { useAuthStore } from "../../stores/authStore";

export const url = `${import.meta.env.VITE_API_URL}`;

export const setHeaders = () => {
  const authStore = useAuthStore();
  const token = authStore.token || localStorage.getItem("token");

  // console.log("Sending Token:", token);

  return {
    headers: {
      Authorization: `Bearer ${token}`,
      Accept: "application/json",
      "Content-Type": "application/json",
    },
  };
};
