import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    isAuthenticated: false,
    token: localStorage.getItem("token") || null,
  }),
  actions: {
    initializeAuth() {
      // Sync isAuthenticated with token on app startup
      this.isAuthenticated = !!this.token;
    },
    setAuthenticated(value) {
      this.isAuthenticated = value;
    },
    setToken(token) {
      this.token = token;
      this.isAuthenticated = true; // Automatically set authenticated when token is set
      localStorage.setItem("token", token);
    },
    clearToken() {
      this.token = null;
      this.isAuthenticated = false; // Automatically clear authenticated state
      localStorage.removeItem("token");
    },
  },
});
