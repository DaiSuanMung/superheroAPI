<template>
  <div id="mainBody" class="container text-center">
    <ul id="results" v-for="(item,index,key) in results" :key="key" @click="save(item)">
      <div class="col-md-12">
        <h4 class="text-center">
          <strong>{{item.name}}</strong>
        </h4>
        <hr />
        <div class="profile-card-6">
          <img :src="item.image.url" class="img img-responsive" />
          <div class="profile-name">{{ item.biography['full-name'] }}</div>
          <div
            class="profile-position"
            style="color:white"
          >{{item.connections['group-affiliation']}}</div>
          <div class="profile-overview">
            <div class="profile-overview">
              <div class="row text-center">
                <div class="col-xs-4">
                  <h3>{{item.powerstats.strength}}</h3>
                  <p>strength</p>
                </div>
                <div class="col-xs-4">
                  <h3>{{item.powerstats.speed}}</h3>
                  <p>speed</p>
                </div>
                <div class="col-xs-4">
                  <h3>{{item.powerstats.power}}</h3>
                  <p>power</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </ul>
    <center v-if="results == undefined">
      <b>No Result Found</b>
    </center>
  </div>
</template>


<script>
import Swal from "sweetalert2";

export default {
  data() {
    return {
      results: [],
      favList: [],
    };
  },
  methods: {
    fetchFav() {
      $("footer").empty();
      $("#searchBox").animate({ "padding-top": "0" }, 600);
      $(".container-fluid").animate({ height: "30vh" }, 600);
      this.results = JSON.parse(localStorage.getItem("favlist"));
    },
    add(item) {
      this.favList.push(item);
      localStorage.setItem("favlist", JSON.stringify(this.favList));
      Swal.fire({
        title: "this here added to your favorite list!",
        icon: "success",
        confirmButtonText: "Cool",
      });
    },
    check(item) {
        var  bool = true;
      if (JSON.parse(localStorage.getItem("favlist")) != null) {
        var list = JSON.parse(localStorage.getItem("favlist"));
        list.forEach((element) => {
          if (element.id === item.id) {
            console.log(element.id);
            console.log(item.id);
            Swal.fire({
              title: "this hero already exists in your favorite list!",
              icon: "error",
              confirmButtonText: "OK",
            });

            bool  = false;
          }
        });   
      }
      return bool;
    },
    save(item) {
      if (this.check(item)) {
        this.add(item);
      }
    },
  },
  created() {
    this.$root.$on("fetchFavEvent", () => {
      this.fetchFav();
    });
    this.$root.$on("ResultEvent", (e) => {
      this.results = e.results;
    });
  },
};
</script>

