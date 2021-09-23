// import { createRouter, createWebHistory } from "vue-router";
import { createRouter, createWebHashHistory } from "vue-router";
import Store from "../store/index.js";
import Home from "../views/Home.vue";
import Medlemsmatrikel from "../views/Medlemsmatrikel.vue";

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
      // if (!this.$cookies.get("concil-git-valid")) {
      // console.log(Store.state.isLoggedIn);
      if (!Store.state.isLoggedIn) {
        // console.log("Ej Inloggad..");
        next("/");
        // return false;
      }
      next();
    },
    component: Medlemsmatrikel,
  },
];

const appPath = `/${window.vueData.app_path}`;

const router = createRouter({
  history: createWebHashHistory(appPath),
  // history: createWebHistory(appPath),
  routes,
});

// const { $cookies } = router.app.config.globalProperties;

export default router;
