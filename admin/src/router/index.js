import { createRouter, createWebHistory } from "vue-router";
import DashboardView from "../views/DashboardView.vue";
import ProfileView from "../views/users/ProfileView.vue";
import LoginView from "../views/LoginView.vue";
import RegisterView from "../views/users/RegisterView.vue";
import EventView from "../views/events/EventView.vue";
import UserView from "../views/users/UserView.vue";
import AddEventView from "../views/events/AddEventView.vue";
import EditEventView from "../views/events/EditEventView.vue";
import AttendeeView from "../views/attendees/AttendeeView.vue";
import AddAttendeeView from "../views/attendees/AddAttendeeView.vue";
import EditAttendeeView from "../views/attendees/EditAttendeeView.vue";
import NotFoundView from "../views/NotFoundView.vue";
import { useAuthStore } from "../stores/authStore";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: DashboardView,
      meta: { requiresAuth: true },
    },
    {
      path: "/login",
      name: "signin",
      component: LoginView,
    },
    {
      path: "/profile",
      name: "profile",
      component: ProfileView,
      meta: { requiresAuth: true },
    },
    {
      path: "/settings",
      name: "settings",
      component: RegisterView,
      meta: { requiresAuth: true },
    },
    {
      path: "/attendee-management",
      name: "attendees",
      component: AttendeeView,
      meta: { requiresAuth: true },
    },
    {
      path: "/attendee-management/create",
      name: "create-attendee",
      component: AddAttendeeView,
      meta: { requiresAuth: true },
    },
    {
      path: "/attendee-management/edit/:id",
      name: "edit-attendee",
      component: EditAttendeeView,
      meta: { requiresAuth: true },
    },
    {
      path: "/event-management",
      name: "events",
      component: EventView,
      meta: { requiresAuth: true },
    },
    {
      path: "/event-management/create",
      name: "create-event",
      component: AddEventView,
      meta: { requiresAuth: true },
    },
    {
      path: "/event-management/edit/:id",
      name: "edit-event",
      component: EditEventView,
      meta: { requiresAuth: true },
    },
    {
      path: "/users",
      name: "users",
      component: UserView,
      meta: { requiresAuth: true },
    },
    {
      path: "/:catchAll(.*)",
      name: "not-found",
      component: NotFoundView,
    },
  ],
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = useAuthStore().isAuthenticated;
  console.log("isAuthenticated:", isAuthenticated);
  console.log("to:", to);
  if (to.matched.some((record) => record.meta.requiresAuth) && !isAuthenticated) {
    next({ name: "signin" });
  } else {
    next();
  }
});

export default router;
