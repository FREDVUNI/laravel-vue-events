import { createRouter, createWebHistory } from "vue-router";
import DashboardView from "../views/DashboardView.vue";
import ProfileView from "../views/users/ProfileView.vue";
import LoginView from "../views/LoginView.vue";
import RegisterView from "../views/users/RegisterView.vue";
import EventView from "../views/events/EventView.vue";
import AddEventView from "../views/events/AddEventView.vue";
import EditEventView from "../views/events/EditEventView.vue";
import AttendeeView from "../views/attendees/AttendeeView.vue";
import AddAttendeeView from "../views/attendees/AddAttendeeView.vue";
import EditAttendeeView from "../views/attendees/EditAttendeeView.vue";
import NotFoundView from "../views/NotFoundView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: DashboardView,
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
    },
    {
      path: "/settings",
      name: "settings",
      component: RegisterView,
    },
    {
      path: "/attendee-management",
      name: "attendees",
      component: AttendeeView,
    },
    {
      path: "/attendee-management/create",
      name: "create-attendee",
      component: AddAttendeeView,
    },
    {
      path: "/attendee-management/create",
      name: "edit-attendee",
      component: EditAttendeeView,
    },
    {
      path: "/event-management",
      name: "events",
      component: EventView,
    },
    {
      path: "/event-management/create",
      name: "create-event",
      component: AddEventView,
    },
    {
      path: "/event-management/create",
      name: "edit-event",
      component: EditEventView,
    },
    {
      path: "/:catchAll(.*)",
      name: "not-found",
      component: NotFoundView,
    },
  ],
});

export default router;
