import { createRouter, createWebHashHistory } from "vue-router";
import Store from "../store/index.js";
import Home from "../views/Home.vue";
import Medlemsmatrikel from "../views/Medlemsmatrikel.vue";
// import Login from "../views/Login.vue";

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
      // console.log(window);
      // console.log(window.location.href);
      console.log(to);
      if (to) {
        console.log("To..");
      } else {
        console.log("No To..");
      }
      if (!Store.state.isLoggedIn || activeMedlemsmatrikel == "") {
        next("/");
        return false;
      }
      next();
    },
    component: Medlemsmatrikel,
  },
  // {
  //   path: "/login",
  //   name: "Login",
  //   component: Login,
  //   beforeEnter(to, from, next) {
  //     console.log(to);
  //     console.log(from);
  //     next();
  //   },
  // },
];

const appPath = `/${window.vueData.app_path}`;

const router = createRouter({
  history: createWebHashHistory(appPath),
  routes,
});

export default router;
