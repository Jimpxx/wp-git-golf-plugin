import { createApp } from "vue";
import App from "./App.vue";
import store from "./store";
import VueCookies from "vue3-cookies";
import router from "./router";

const app = createApp(App);

app.use(store);
app.use(router);
// router.app = app;

app.use(VueCookies);

app.mount("#app");

// createApp(App).use(VueCookies).use(router).use(store).mount("#app");
