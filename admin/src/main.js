import "./assets/main.css";
import "./index.css";

import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "./App.vue";
import { useAuthStore } from "./stores/authStore";
import router from "./router";
import "vuetify/styles";
import "vue3-toastify/dist/index.css";

import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

const pinia = createPinia();

const vuetify = createVuetify({
  components,
  directives,
});

const app = createApp(App);

app.use(vuetify);
app.use(pinia);
app.use(router);

app.component("useAuthStore", useAuthStore);
app.mount("#app");
