<style scoped>
.btnMain{
	font-size: 1.6rem;
    font-weight: 700;
	background-color: #6f76ac;
	color: white !important;
}
.btnMain:hover{
	transition: 0.5s;
	background-color: #252B86;
	color: #96A1EE !important;
}
</style>
<template>
    <div class="container-fluid d-flex align-items-center justify-content-center mt-2" style="height: 90vh;">
      <div class="d-flex flex-row align-items-center justify-content-center flex-wrap gap-5">
        <div v-for="game in games">
          <RouterLink :to="{path: '/game/'+game.id}" class="btn btnMain fs-5 d-flex align-items-center justify-content-center" style="width: 300px; height:120px;">
            {{ game.title }}
          </RouterLink>
        </div>
      </div>
    </div>
    <router-view></router-view>
    </template>

    <script>
    import axios from 'axios'
    import {link} from '@/main'
    import { RouterLink, RouterView } from 'vue-router';
    export default {
      data() {
        return {
          games:[],
        };
      },
      methods: {
        getGames(){
          axios.get(`${link}/api/games`).then(res => {
            this.games = res.data;
          });
        },
        GamePage(id){
          console.log(id);
        }
      },
      mounted() {
        if(document.querySelector('head').lastChild.tagName == "LINK"){
            document.querySelector('head').lastChild.remove();
        }
        this.getGames();
      },
    };
    </script>
    <style scoped></style>
