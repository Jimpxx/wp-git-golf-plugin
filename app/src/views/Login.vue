<template>
  <div class="login">
    <h2>Logga in</h2>
    <p>
      För att komma åt informationen behöver du logga in med ditt Golf-ID och
      lösenord.
    </p>
    <form @submit.prevent="doLogin">
      <div>
        <label for="username">Golf-ID (ååmmdd-xxx)</label>
        <input type="text" id="username" name="username" v-model="username" />
      </div>
      <div>
        <label for="password">Lösenord</label>
        <input
          type="password"
          id="password"
          name="password"
          v-model="password"
        />
      </div>
      <button>Logga in</button>
    </form>
    <p v-if="error">{{ error }}</p>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      username: "",
      password: "",
      checkUser: false,
      error: null,
      gitLoginButtonColor: window.vueData.git_login_button_color,
      gitLoginButtonTextColor: window.vueData.git_login_button_text_color,
      gitLoginHeadingColor: window.vueData.git_login_heading_color,
      gitLoginLabelColor: window.vueData.git_login_label_color,
      gitLoginInputBorder: `1px solid ${window.vueData.git_login_input_border_color}`,
      gitLoginInputBorderActiveColor:
        window.vueData.git_login_input_border_active_color,
    };
  },
  methods: {
    async doLogin() {
      if (!this.username.match(/^[0-9]{6}-[0-9]{3}$/)) {
        this.error = "Username must be a golf-id";
        this.username = "";
        this.password = "";
        return;
      }
      const url = "https://golf.concil.se/login";
      const body = {
        guid: window.vueData.git_guid,
        gitUsername: window.vueData.git_username,
        gitPassword: window.vueData.git_password,
        username: this.username,
        password: this.password,
      };
      const data = await axios.post(url, body, {
        headers: { "Content-Type": "application/json" },
      });
      console.log(
        data.data["soap:Envelope"]["soap:Body"][0][
          "types:CheckUserLoginClubResponse"
        ][0]["CheckUserLoginClubResult"][0]._
      );

      this.checkUser =
        data.data["soap:Envelope"]["soap:Body"][0][
          "types:CheckUserLoginClubResponse"
        ][0]["CheckUserLoginClubResult"][0]._ === "true"
          ? true
          : false;

      console.log(this.checkUser);
      if (this.checkUser) {
        this.$cookies.set("concil-git-valid", true, "1h");
        // window.location.reload(); // Javascript reload
        this.$router.go("/"); // Vue Router reload
        // window.history.go(-2);
      } else {
        this.error =
          "Felaktig inloggningsuppgifter, Alternativt är du inte medlem i klubben.";
        this.username = "";
        this.password = "";
      }
    },
  },
};
</script>

<style lang="scss">
.login {
  h2 {
    color: v-bind(gitLoginHeadingColor);
    // color: #004987;
  }
  p {
    font-size: 1.1rem;
    margin-bottom: 0.7rem;
  }
  form {
    input {
      width: 100%;
      border: v-bind(gitLoginInputBorder);
      // border: 1px solid #004987;
      border-radius: 5px;
      margin: 0 0 15px 0;
      padding: 0.7rem;
    }
    input:focus {
      outline: none;
      border-color: v-bind(gitLoginInputBorderActiveColor);
      // border-color: #1472c5;
      background-color: #ffffff;
    }
    label {
      display: block;
      text-align: left;
      color: v-bind(gitLoginLabelColor);
      // color: #004987;
      margin-bottom: 0;
      font-size: 0.8rem;
    }
    button {
      border-radius: 5px;
      padding: 0.5rem 1rem;
      margin-top: 1rem;
      background-color: v-bind(gitLoginButtonColor);
      // background-color: #004987;
      color: v-bind(gitLoginButtonTextColor);
      // color: #fff;
      &:hover {
        filter: brightness(1.1);
      }
    }
  }
}
</style>
