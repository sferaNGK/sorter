<template>
    <div class="main">
      <RadButton @change="Check($event)"/>
        <div class="row col-12 p-5">
          <DragPlace v-bind:children="children" v-bind:categories="categories[0]" v-bind:list1="list1" v-bind:cat="cat1"></DragPlace>
          <DragPlace v-bind:children="children" v-bind:categories="categories[1]" v-if="cat2 != ''" v-bind:list1="list2" v-bind:cat="cat2"></DragPlace>
          <DragPlace v-bind:children="children" v-bind:categories="categories[2]" v-if="cat3 != ''" v-bind:list1="list3" v-bind:cat="cat3"></DragPlace>
          <DragPlace v-bind:children="children" v-bind:categories="categories[3]" v-if="cat4 != ''" v-bind:list1="list4" v-bind:cat="cat4"></DragPlace>
        </div>
        <DragWord v-if="words.length > 0" v-bind:words="words"/>
    </div>
    
    <div class="container-fluid d-flex justify-content-center h-25" v-if="adult" style="margin-top: -100px;">
        <button @click="CheckResult" class="btn btn-primary w-25">Проверить</button>
    </div>
</template>
<script>
import axios from 'axios'
import {link} from '@/main'
import draggable from "vuedraggable"
import DragPlace from '@/components/global/DragPlace.vue';
import DragWord from '@/components/global/DragWord.vue'
export default {
  components: {
    draggable, DragPlace, DragWord
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
        if(this.games.length == 4){ this.cat4 = this.games[3].category.title}

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
    CheckResult(){

        if(this.list1.length != 0){
            for(let i = 0; i < this.list1.length; i++){
             let word = document.getElementById(`element_${this.list1[i].id}`);
             console.log(word);
              if(this.categories[0].includes(this.list1[i]) && this.list1[i].title == word.textContent){word.classList.add('right');}
              else{word.classList.add('wrong');}
            }
        }
        if(this.list2.length != 0){
          for(let i = 0; i < this.list2.length; i++){
            let word = document.getElementById(`element_${this.list2[i].id}`);
              if(this.categories[1].includes(this.list2[i]) && this.list2[i].title == word.textContent){ word.classList.add('right');}
              else{word.classList.add('wrong');}
            }
        }
        if(this.list3.length != 0){
          for(let i = 0; i < this.list3.length; i++){
            let word = document.getElementById(`element_${this.list3[i].id}`);
              if(this.categories[2].includes(this.list3[i]) && this.list3[i].title == word.textContent){word.classList.add('right');}
              else{word.classList.add('wrong');}
            }
        }
        if(this.list4.length !=0){
          for(let i = 0; i < this.list3.length; i++){
            let word = document.getElementById(`element_${this.list4[i].id}`);
              if(this.categories[3].includes(this.list4[i]) && this.list4[i].title == word.textContent){word.classList.add('right');}
              else{word.classList.add('wrong');}
            }
        }

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
