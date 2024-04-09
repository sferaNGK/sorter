<template>
    <div class="main">
      <RadButton @change="Check($event)"/>
        <div class="row col-12 p-5">
          <DragPlace v-bind:children="children" v-bind:categories="categories[0]" v-bind:list1="list1" v-bind:cat="cat1"></DragPlace>
          <DragPlace class="mb-2" v-bind:children="children" v-bind:categories="categories[1]" v-if="cat2 != ''" v-bind:list1="list2" v-bind:cat="cat2"></DragPlace>
          <DragPlace v-bind:children="children" v-bind:categories="categories[2]" v-if="cat3 != ''" v-bind:list1="list3" v-bind:cat="cat3"></DragPlace>
          <DragPlace v-bind:children="children" v-bind:categories="categories[3]" v-if="cat4 != ''" v-bind:list1="list4" v-bind:cat="cat4"></DragPlace>
        </div>
        <DragWord v-if="words.length > 0" v-bind:words="words"/>
    </div>
    
    <CheckButt v-if="adult" v-bind:list1="list1" v-bind:list2="list2" v-bind:list3="list3" v-bind:list4="list4" v-bind:categories="categories"/>
  
</template>
<script>
import axios from 'axios'
import {link} from '@/main'
import draggable from "vuedraggable"
import DragPlace from '@/components/global/DragPlace.vue';
import DragWord from '@/components/global/DragWord.vue'
import CheckButt from '@/components/global/CheckButt.vue'
export default {
  components: {
    draggable, DragPlace, DragWord, CheckButt
  },
  data() {
    return {
        // Отображающиеся слова
      list1: [],
      list2: [],
      list3: [],
      list4: [],

    //   Запрос
      games:[],

    //   Категории
      cat1:'',
      cat2:'',
      cat3:'',
      cat4:'',
      categories:[],
      words:[],

    //   Проверка
        children: false,
        adult: false,
    };
  },
  methods: {
    getGames(id){
      axios.get(`${link}/api/game/${id}`).then(res => {
        this.games = res.data;

        this.cat1 = this.games[0].category.title;
        this.cat2 = this.games[1].category.title;
        if(this.games.length == 3){ this.cat3 = this.games[2].category.title}
        if(this.games.length == 4){ this.cat3 = this.games[2].category.title;this.cat4 = this.games[3].category.title}

        this.games.forEach(element => {
          this.categories.push(element.category_id);
        });
  
        this.games.forEach(element => {
           element.category_id.forEach(elem => {
            this.words.push(elem);
           });
        });
      });
    },
    Check(event){
        if(event.target.value == 'child'){
            this.adult = false;
            this.children = true;
        }else{
            this.adult = true;
            this.children = false;

        }
    }
  },
  mounted() {
    this.getGames(this.$route.params.id);
  },
};
</script>
