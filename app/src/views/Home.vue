<template>
  <div class="home">
    <Login v-if="!isLoggedIn" />
    <div v-else>
      <p>
        <span class="success">Du är inloggad!</span> Din session är aktiv i 1h
        från att du loggade in.
      </p>
      <p>Ursäkta avbrottet, navigera till sidan igen.</p>
    </div>
  </div>
</template>

<script>

import Login from "../components/Login.vue";

export default {
  name: "Home",
  components: {
    Login,
  },
  computed: {
    isLoggedIn() {
      return this.$cookies.get("concil-git-valid") ? true : false;
    },
  },
  beforeCreate() {
    if (
      this.$cookies.get("concil-git-valid") &&
      window.vueData.git_active_medlemsmatrikel == "1"
    ) {
      this.$router.push({ name: "Medlemsmatrikel" });
    }
  },
};
</script>

<style scoped lang="scss">
.success {
  color: rgb(25, 201, 25);
}
</style>
