<template>
    <ModalFirst/>
    <ModalEnd :v-bind:modal="modal" v-if="modal == true"/>
    <div class="main">
        <RadButton @change="Check($event)"/>
        <div class="row col-12 p-5">
            <DragPlace v-bind:children="children" v-bind:categories="categories[0]" v-bind:list1="list1" v-bind:cat="cat1"></DragPlace>
            <DragPlace class="mb-2" v-bind:children="children" v-bind:categories="categories[1]" v-if="cat2 != ''" v-bind:list1="list2" v-bind:cat="cat2"></DragPlace>
            <DragPlace v-bind:children="children" v-bind:categories="categories[2]" v-if="cat3 != ''" v-bind:list1="list3" v-bind:cat="cat3"></DragPlace>
            <DragPlace v-bind:children="children" v-bind:categories="categories[3]" v-if="cat4 != ''" v-bind:list1="list4" v-bind:cat="cat4"></DragPlace>
        </div>
        <DragWord v-if="words.length > 0" v-bind:words="words"/>
            <div class="container-fluid d-flex justify-content-center" style="margin-top: 250px;" @click="CheckRes">
                <CheckButt v-if="adult" v-bind:list1="list1" v-bind:list2="list2" v-bind:list3="list3" v-bind:list4="list4" v-bind:categories="categories"/>
            </div>
    </div>
</template>
<script>
import axios from 'axios'
import {link} from '@/main'
import draggable from "vuedraggable"
import DragPlace from '@/components/global/DragPlace.vue';
import DragWord from '@/components/global/DragWord.vue'
import CheckButt from '@/components/global/CheckButt.vue'
import ModalFirst from '@/components/global/ModalFirst.vue'
import ModalEnd from '@/components/global/ModalEnd.vue'
export default {
  components: {
    draggable, DragPlace, DragWord, CheckButt, ModalFirst, ModalEnd
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
      length:0,

    //   Категории
      cat1:'',
      cat2:'',
      cat3:'',
      cat4:'',
      categories:[],
      words:[],

    //   CSS file
      path:'',
      arrayStyle:[],

    //   Проверка
        children: false,
        adult: false,
        modal: false,
    };
  },
  methods: {
    getGames(id){
      axios.get(`${link}/api/game/${id}`).then(res => {
        this.games = res.data;
        this.path = this.games[0].game.style_id.path;

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
    this.length = this.words.length;
    this.words.sort(()=> Math.random() - 0.5);
});
    },
    CheckRes(){
        if(this.words.length == 0){
            let wod = document.querySelectorAll('.right');
                if(wod.length == this.length){
                    this.modal = true;
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
    },
    CreateCss(id){
        axios.get(`${link}/api/gamed/${id}`).then(res => {
            this.arrayStyle = res.data;
            var css = document.createElement( "link" );
            css.href = `${link}${this.arrayStyle.style.path}`;
            css.type = "text/css";
            css.rel = "stylesheet";
            css.media = "screen,print";
            document.head.appendChild(css)
        });
    }
  },
  watch:{
    words:{
        handler(){
            if(this.children){
                setTimeout(()=>{
                    let wod = document.querySelectorAll('.right');
                    if(wod.length == this.length){
                        this.modal = true;
                    }
                },70)
            }

        },
        deep:true
    }
    },
  mounted() {
    this.CreateCss(this.$route.params.id);
    this.getGames(this.$route.params.id);
  },
};
</script>
