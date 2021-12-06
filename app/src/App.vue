<template>
  <div>
    <div v-if="isLoggedIn" id="nav">
      <!-- <router-link to="/">Home</router-link> | -->
      <router-link v-if="activeMedlemsmatrikel == 1" to="/"
        >Medlemssidor</router-link
      >
      <!-- <button class="logout-btn" @click="logout">Logga ut från GIT</button> -->
    </div>
    <router-view />
  </div>
</template>

<script>
export default {
  components: {},
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
  // methods: {
  //   logout() {
  //     this.$cookies.remove("concil-git-valid");
  //     this.$router.go();
  //   },
  // },
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

  .logout-btn {
    background-color: #004987;
    color: #fff;
    padding: 0.8rem 1.6rem;
    &:hover {
      filter: brightness(1.1);
    }
  }

  a {
    font-weight: bold;
    color: v-bind(gitCardLinkColor);

    &:hover {
      filter: brightness(1.5);
    }

    &.router-link-exact-active {
      color: v-bind(gitCardLinkHoverColor);
    }
  }
}
</style>
