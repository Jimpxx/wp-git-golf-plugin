<template>
  <div class="home">
    <!-- <img alt="Vue logo" src="../assets/logo.png" /> -->
    <!-- <HelloWorld msg="Welcome to Your Vue.js App" /> -->
    <Login v-if="!isLoggedIn" />
    <div v-else>
      <p>Du är inloggad! Ursäkta avbrottet, navigera till sidan igen.</p>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
// import HelloWorld from "@/components/HelloWorld.vue";
import Login from "../components/Login.vue";

export default {
  name: "Home",
  components: {
    Login,
    // HelloWorld,
  },
  computed: {
    isLoggedIn() {
      return this.$cookies.get("concil-git-valid") ? true : false;
    },
  },
  beforeCreate() {
    if (this.$cookies.get("concil-git-valid")) {
      this.$router.push({ name: "Medlemsmatrikel" });
    }
  },
};
</script>
