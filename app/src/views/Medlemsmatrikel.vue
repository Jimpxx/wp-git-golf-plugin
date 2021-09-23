<template>
  <div class="medlemsmatrikel">
    <!-- <table v-if="members.length > 0">
      <thead>
        <tr>
          <th>Namn</th>
          <th>GolfID</th>
          <th>Handikapp</th>
          <th>Telefon</th>
          <th>Ort</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="member in members" :key="member.GolfID[0]._">
          <td>{{ member.FirstName[0]._ }} {{ member.LastName[0]._ }}</td>
          <td>{{ member.GolfID[0]._ }}</td>
          <td>{{ member.LastKnownHCP[0]._ }}</td>
          <td>{{ member.MobileNumber_Private[0]._ }}</td>
          <td>{{ member.PostalAddress_Residence[0]._ }}</td>
        </tr>
      </tbody>
    </table> -->
    <!-- <img
      v-if="loading"
      class="loading-svg"
      src="@/assets/eclipse.svg"
      alt="Loading.."
    /> -->
    <loading-icon v-if="loading"></loading-icon>
    <ul v-else>
      <li class="item" v-for="member in members" :key="member.GolfID[0]._">
        <div class="item-container">
          <div class="item-sides">
            <div class="item-content-left">
              <div class="name">
                <label for="name">Namn</label>
                <p id="name">
                  {{ member.FirstName[0]._ }} {{ member.LastName[0]._ }}
                </p>
              </div>
              <div class="hcp">
                <label for="hcp">HCP</label>
                <p id="hcp">{{ member.LastKnownHCP[0]._ }}</p>
              </div>
            </div>
            <div class="item-content-right">
              <div class="id">
                <label for="golfid">Golf-ID</label>
                <p id="golfid">{{ member.GolfID[0]._ }}</p>
              </div>
              <div class="phone">
                <label for="phone">Telefon</label>
                <p id="phone">{{ member.MobileNumber_Private[0]._ }}</p>
              </div>
            </div>
          </div>
          <div class="item-footer"></div>
          <!-- <div class="first-row">
            <div class="user-name">
              <label for="name">Namn</label>
              <p id="name">
                {{ member.FirstName[0]._ }} {{ member.LastName[0]._ }}
              </p>
            </div>
            <div class="user-id">
              <label for="golfid">Golf-ID</label>
              <p id="golfid">{{ member.GolfID[0]._ }}</p>
            </div>
          </div>
          <div class="second-row">
            <div class="user-hcp">
              <label for="hcp">HCP</label>
              <p id="hcp">{{ member.LastKnownHCP[0]._ }}</p>
            </div>
            <div class="user-phone">
              <label for="phone">Telefon</label>
              <p id="phone">{{ member.MobileNumber_Private[0]._ }}</p>
            </div>
          </div> -->
          <!-- <div class="third-row">
            <div class="user-residence">
              <p>Ort: {{ member.PostalAddress_Residence[0]._ }}</p>
            </div>
          </div> -->
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";

import LoadingIcon from "@/components/LoadingIcon.vue";

export default {
  props: ["guid", "username", "password"],
  components: {
    LoadingIcon,
  },
  data() {
    return {
      members: [],
      loading: false,
      gitCardBackgroundColor: window.vueData.git_card_background_color,
      gitCardTextColor: window.vueData.git_text_color,
      gitCardLabelColor: window.vueData.git_label_color,
      gitLoadingIconColor: window.vueData.git_loading_icon_color,
      gitCardBorderColor: "2px solid " + window.vueData.git_border_color,
      gitCardBorderTopColor: "2px solid " + window.vueData.git_border_top_color,
    };
  },
  methods: {
    async sendReq() {
      this.loading = true;
      const url = "https://golf.concil.se/medlemsmatrikel";
      const body = {
        guid: window.vueData.git_guid,
        gitUsername: window.vueData.git_username,
        gitPassword: window.vueData.git_password,
        // guid: this.guid,
        // username: this.username,
        // password: this.password,
      };
      const data = await axios.post(url, body, {
        headers: { "Content-Type": "application/json" },
      });
      // console.log(data);
      this.members =
        data.data["soap:Envelope"]["soap:Body"][0][
          "types:PersonInfoMatrikelDataOrgUnit"
        ];
      this.loading = false;
    },
  },
  // computed: {
  //   cardStyle() {
  //     return {
  //       "background-color": this.gitCardBackgroundColor,
  //       // color: this.gitCardTextColor,
  //       // border: "2px solid " + this.gitCardBorderColor,
  //       // "border-top": "2px solid " + this.gitCardBorderTopColor,
  //     };
  //   },
  // },
  created() {
    this.sendReq();
  },
};
</script>

<style lang="scss">
/* table {
  width: 100%;
} */
.medlemsmatrikel {
  text-align: left;
  .loading-svg {
    display: block;
    margin: auto;
    fill: #a3834f;
    // color: #004987;
  }
  ul {
    list-style: none;
    padding-left: 0;
    .item {
      .item-container {
        label {
          display: block;
          // text-align: left;
          color: v-bind(gitCardLabelColor);
          // color: #a3834f;
          // color: #004987;
          margin-bottom: 0;
          font-weight: bold;
          font-size: 0.8rem;
        }
        .item-sides {
          display: flex;
          justify-content: space-between;
          .item-content-left {
            text-align: left;
          }
          .item-content-right {
            text-align: right;
          }
        }
        // .first-row,
        // .second-row {
        //   display: flex;
        //   justify-content: space-between;
        // }
        // .first-row {
        //   .user-name {
        //   }
        // }
        // .third-row {
        //   .user-residence p {
        //     text-transform: capitalize;
        //   }
        // }
      }
      background: v-bind(gitCardBackgroundColor);
      // background: #333;
      // color: #fff;
      color: v-bind(gitCardTextColor);
      // background: #fefefe;
      // border: 2px #333333 solid;
      // border: 2px #eee solid;
      border: v-bind(gitCardBorderColor);
      border-top: v-bind(gitCardBorderTopColor);
      // border-top: 2px solid #004987;
      // border-top: 2px solid #a3834f;
      border-radius: 5px;
      margin-bottom: 1rem;
      padding: 0.7rem;
    }
  }
}

@media only screen and (max-width: 600px) {
  .medlemsmatrikel {
    font-size: 1rem;
  }
}

@media only screen and (max-width: 450px) {
  .medlemsmatrikel {
    font-size: 0.8rem;
    .item {
      padding: 0.5rem;
    }
  }
}
</style>
