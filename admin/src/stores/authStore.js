import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    isAuthenticated: false,
    token: localStorage.getItem("token") || null,
  }),
  actions: {
    setAuthenticated(value) {
      this.isAuthenticated = value;
    },
    setToken(token) {
      this.token = token;
      localStorage.setItem("token", token);
    },
    clearToken() {
      this.token = null;
      localStorage.removeItem("token");
    },
  },
});
