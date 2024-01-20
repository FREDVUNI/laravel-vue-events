import "./assets/main.css";
import "./index.css";

import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "./App.vue";
import { useAuthStore } from "./stores/authStore";
import router from "./router";

const pinia = createPinia();

const app = createApp(App);

app.use(pinia);
app.component("useAuthStore", useAuthStore);
app.use(router);

app.mount("#app");

