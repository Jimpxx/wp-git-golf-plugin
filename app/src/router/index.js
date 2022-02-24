import { createRouter, createWebHashHistory } from "vue-router";
// import Store from "../store/index.js";
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
      // console.log(Store.state.isLoggedIn);
      // if (!Store.state.isLoggedIn || activeMedlemsmatrikel == "") {
      if (!getCookie("concil-git-valid") || activeMedlemsmatrikel == "") {
        // this.$cookies.set("concil-icamefrom", "/medlemsmatrikel", "1h");
        // console.log(window.location.href);
        document.cookie =
          "concil-icamefrom=" + window.location.href + ";expires=3600;path=/";
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

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

export default router;
