import { createRouter, createWebHashHistory } from "vue-router";
import Store from "../store/index.js";
import Home from "../views/Home.vue";
import Medlemsmatrikel from "../views/Medlemsmatrikel.vue";

const activeMedlemsmatrikel = window.vueData.git_active_medlemsmatrikel;

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/medlemsmatrikel",
    name: "Medlemsmatrikel",
    beforeEnter(to, from, next) {
      if (!Store.state.isLoggedIn || activeMedlemsmatrikel == "") {
        next("/");
        return false;
      }
      next();
    },
    component: Medlemsmatrikel,
  },
];

const appPath = `/${window.vueData.app_path}`;

const router = createRouter({
  history: createWebHashHistory(appPath),
  routes,
});

export default router;
