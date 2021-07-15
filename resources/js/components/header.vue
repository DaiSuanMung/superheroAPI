<template>
  <header class="container-fluid" @keydown.enter="search"> 
    <div class="container text-center" id="searchBox">
      <h1>Super Heroes Search Engine</h1>
      <div class="form col-xs-12">
        <input class="col-xs-9" id="searchBar" type="text" placeholder="search (EX:batman)" v-model="searchRequest"/>
        <span
          @click="search"
          class="glyphicon glyphicon-search col-xs-1"
          data-toggle="tooltip"
          title="Search"
        ></span>
    
         <span class="glyphicon bar col-xs-1" id="submit">
          <b>|</b>
        </span>
        <a href="javascript:void(0)" @click="fetchFav">
          <span
            class="glyphicon glyphicon-heart col-xs-1"
            data-toggle="tooltip"
            title="favorites Heros"
          ></span>
        </a>
      </div>
    </div>
  </header>
</template>


<script>
export default {
  
    data(){
        return{
          
            searchRequest:'',
            result:[],
        }
        
    },
  methods: {
      fetchFav(){
         this.$root.$emit("fetchFavEvent")
      },
    animateResult() {
      $("footer").empty();
      $("#searchBox").animate({ "padding-top": "0" }, 600);
      $(".container-fluid").animate({ height: "30vh" }, 600);
    },
    search() {
       
      this.axios.get("/api/superhero/"+ this.searchRequest).then((response) => {
       // console.log(response.data);
       this.animateResult()
         this.$root.$emit("ResultEvent",response.data)
      }).catch(err => {  
          console.log(err);
        });
    },
  },
};
</script>