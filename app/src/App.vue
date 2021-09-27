<template>
  <div>
    <div v-if="isLoggedIn" id="nav">
      <!-- <router-link to="/">Home</router-link> | -->
      <router-link v-if="activeMedlemsmatrikel == 1" to="/medlemsmatrikel"
        >Medlemsmatrikel</router-link
      >
    </div>
    <router-view />
  </div>
</template>

<script>
// import Login from "./components/Login.vue";
// import Medlemsmatrikel from "./components/Medlemsmatrikel.vue";

export default {
  components: {
    // Login,
    // Medlemsmatrikel,
  },
  data() {
    return {
      vueData: window.vueData,
      gitCardLinkColor: window.vueData.git_link_color,
      gitCardLinkHoverColor: window.vueData.git_link_hover_color,
      activeMedlemsmatrikel: window.vueData.git_active_medlemsmatrikel,
    };
  },
  computed: {
    isLoggedIn() {
      return this.$cookies.get("concil-git-valid") ? true : false;
    },
  },
  created() {
    this.$store.dispatch(
      "setLoggedIn",
      this.$cookies.get("concil-git-valid") ? true : false
    );
  },
};
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  width: 100%;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: v-bind(gitCardLinkColor);
    // color: #977742;
    // color: #2c3e50;

    &:hover {
      filter: brightness(1.5);
    }

    &.router-link-exact-active {
      // filter: brightness(0.85);
      color: v-bind(gitCardLinkHoverColor);
      // color: #a3834f;
      // color: #004987;
      // color: #42b983;
    }
  }
}
</style>
