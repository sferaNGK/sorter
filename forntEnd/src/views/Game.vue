<template>
    <ModalFirst/>
    <ModalEnd :v-bind:modal="modal" :count="count" :length="length" v-bind:children="children" v-if="modal == true"/>
    <div class="main d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex flex-row flex-wrap align-items-center justify-content-center gap-3 col-12">
            <DragPlace v-on:changeValue="changeValue" class="first" :length="length" v-bind:children="children" v-bind:categories="categories[0]" v-bind:list1="list1" v-bind:cat="cat1" :two="two" :three="three" :four="four"></DragPlace>
            <DragPlace v-on:changeValue="changeValue" class="second" :length="length" v-bind:children="children" v-bind:categories="categories[1]" v-if="cat2 != ''" v-bind:list1="list2" v-bind:cat="cat2" :two="two" :three="three" :four="four"></DragPlace>
            <DragPlace v-on:changeValue="changeValue" class="third" :length="length" v-bind:children="children" v-bind:categories="categories[2]" v-if="cat3 != ''" v-bind:list1="list3" v-bind:cat="cat3" :two="two" :three="three" :four="four"></DragPlace>
            <DragPlace v-on:changeValue="changeValue" class="fourth" :length="length" v-bind:children="children" v-bind:categories="categories[3]" v-if="cat4 != ''" v-bind:list1="list4" v-bind:cat="cat4" :two="two" :three="three" :four="four"></DragPlace>
        </div>
        <DragWord v-if="words.length > 0" v-bind:words="words" v-bind:adult="adult"/>
            <div v-if="adult" class="container-fluid d-flex justify-content-center mt-5">
                <CheckButt v-if="adult" v-on:changeValue="changeValue" v-bind:list1="list1" v-bind:list2="list2" v-bind:list3="list3" v-bind:list4="list4" v-bind:categories="categories"/>
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

    //   Число верных ответов
      count:0,

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

        // Кол-во элементов
        two:false,
        three:false,
        four:false,
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
    if(this.games[0].game.button == 'false'){
        this.children = true;
        this.adult = false;
    } else if(this.games[0].game.button == 'true'){
        this.children = false;
        this.adult = true;
    }
    setTimeout(() => {
        if(this.categories.length == 2){
            this.two = true;
            document.querySelector('.first').style.backgroundImage = 'url(/src/assets/images/Left.svg)';
            document.querySelector('.second').style.backgroundImage = 'url(/src/assets/images/right.svg)';
        } else if(this.categories.length == 3){
            document.querySelector('.first').style.backgroundImage = 'url(/src/assets/images/Left.svg)';
            document.querySelector('.second').style.backgroundImage = 'url(/src/assets/images/Right.svg)';
            document.querySelector('.third').style.backgroundImage = 'url(/src/assets/images/Down.svg)';
            document.querySelector('.third').classList.add('col-10');

            this.three = true;
        } else{
            document.querySelector('.first').style.backgroundImage = 'url(/src/assets/images/Left_up.svg)';
            document.querySelector('.second').style.backgroundImage = 'url(/src/assets/images/Right_up.svg)';
            document.querySelector('.third').style.backgroundImage = 'url(/src/assets/images/Left_down.svg)';
            document.querySelector('.fourth').style.backgroundImage = 'url(/src/assets/images/Right_down.svg)';
            this.four = true;
        }
    }, 50);

});
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
    },
    changeValue(value){
       this.count = value;
       if(this.words.length == 0){
            this.modal = true;
        }
    }
  },
  mounted() {
    this.CreateCss(this.$route.params.id);
    this.getGames(this.$route.params.id);

  },
};
</script>
