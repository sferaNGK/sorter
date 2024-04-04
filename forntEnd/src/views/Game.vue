<template>
    <div class="main">

        <div class="container-fluid d-flex flex-row gap-5 mt-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" value="child" id="flexRadioDefault1" @change="Check($event)">
                <label class="form-check-label" for="flexRadioDefault1">
                  Детская (без кнопки)
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" value="adult" id="flexRadioDefault2" @change="Check($event)">
                <label class="form-check-label" for="flexRadioDefault2">
                  Взрослая (с кнопкой)
                </label>
              </div>
        </div>

        <div class="row col-12 p-5">

          <div class="col-6 h-100">
              <h3 class="text-center">{{ cat1 }}</h3>
              <draggable
                class="list-group p-2 border rounded mt-3"
                :list="list1"
                group="people"
                itemKey="name"
              >
                <template #item="{ element }">
                  <div class="list-group-item border rounded text-center" :id="`element_${element.id}`">{{ element.title  }}</div>
                </template>
              </draggable>
          </div>

          <div class="col-6 h-100 mb-2" v-if="cat2 != ''">
              <h3 class="text-center">{{ cat2 }}</h3>
              <draggable
                class="list-group p-2 mt-3 border rounded"
                :list="list2"
                group="people"
                itemKey="name"
              >
                <template #item="{ element }">
                  <div class="list-group-item border rounded text-center" :id="`element_${element.id}`">{{ element.title  }}</div>
                </template>
              </draggable>
          </div>

          <div class="col-6 h-100" v-if="cat3 != ''">
              <h3 class="text-center">{{ cat3 }}</h3>
              <draggable
                class="list-group p-2 mt-3 border rounded"
                :list="list3"
                group="people"
                itemKey="name"
              >
                <template #item="{ element }">
                  <div class="list-group-item border rounded  text-center" :id="`element_${element.id}`">{{ element.title  }}</div>
                </template>
              </draggable>
          </div>

          <div class="col-6 h-100" v-if="cat4 != ''">
              <h3 class="text-center">{{ cat4 }}</h3>
              <draggable
                class="list-group p-2 mt-3 border rounded"
                :list="list4"
                group="people"
                itemKey="name"
              >
                <template #item="{ element }">
                  <div class="list-group-item border rounded  text-center" :id="`element_${element.id}`">{{ element.title }}</div>
                </template>
              </draggable>
          </div>

        </div>
        <div class="col-12 d-flex align-items-end justify-content-center" style="position: absolute;">
          <div class="w-50 h-50 border rounded p-5" v-if="words.length != 0">
              <draggable
                class="list-group lg"
                :list="words"
                group="people"
                itemKey="name"
              >
                <template #item="{ element }">
                  <div class="list-group-item border rounded text-center">{{ element.title }}</div>
                </template>
          </draggable>
          </div>
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-center h-25" v-if="adult" style="margin-top: -100px;">
        <button @click="CheckResult" class="btn btn-primary w-25">Проверить</button>
    </div>
</template>

<script>
import axios from 'axios'
import {link} from '@/main'
import draggable from "vuedraggable";
let id = 1;
export default {
  components: {
    draggable
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
      categories:[

      ],


      words:[],

    //   Проверка
        children: false,
        adult: false,
    };
  },
  watch:{
    list1:{
      handler(){
        if(this.children){
            setTimeout(() => {
                  let word;
                  this.list1.forEach(element => {
                      word = document.getElementById(`element_${element.id}`);
                  });
                  this.categories[0].forEach(elem => {
                      if(elem.title != word.innerHTML){
                          word.style.backgroundColor="red";
                          word.style.color="white";
                      }
                  });
                  this.categories[0].forEach(elem => {
                      if(elem.title == word.innerHTML){
                          word.style.backgroundColor="green";
                          word.style.color="white";
                      }
                  });
              }, 50);
        }
      },
      deep:true
    },
    list2:{
      handler(){
        if(this.children){
            setTimeout(() => {
                  let word;
                  this.list2.forEach(element => {
                      word = document.getElementById(`element_${element.id}`);
                  });
                  this.categories[1].forEach(elem => {
                      if(elem.title != word.innerHTML){
                          word.style.backgroundColor="red";
                          word.style.color="white";
                      }
                  });
                  this.categories[1].forEach(elem => {
                      if(elem.title == word.innerHTML){
                          word.style.backgroundColor="green";
                          word.style.color="white";
                      }
                  });
              }, 50);
        }
      },
      deep:true
    },
    list3:{
      handler(){
        if(this.children){
            setTimeout(() => {
                  let word;
                  this.list3.forEach(element => {
                      word = document.getElementById(`element_${element.id}`);
                  });
                  this.categories[2].forEach(elem => {
                      if(elem.title != word.innerHTML){
                          word.style.backgroundColor="red";
                          word.style.color="white";
                      }
                  });
                  this.categories[2].forEach(elem => {
                      if(elem.title == word.innerHTML){
                          word.style.backgroundColor="green";
                          word.style.color="white";
                      }
                  });
              }, 50);
        }
      },
      deep:true
    },
    list4:{
      handler(){
        if(this.children){
            setTimeout(() => {
                  let word;
                  this.list4.forEach(element => {
                      word = document.getElementById(`element_${element.id}`);
                  });
                  this.categories[3].forEach(elem => {
                      if(elem.title != word.innerHTML){
                          word.style.backgroundColor="red";
                          word.style.color="white";
                      }
                  });
                  this.categories[3].forEach(elem => {
                      if(elem.title == word.innerHTML){
                          word.style.backgroundColor="green";
                          word.style.color="white";
                      }
                  });
              }, 50);
        }
      },
      deep:true
    },
  },
  methods: {
    getGames(id){
      axios.get(`${link}/api/game/${id}`).then(res => {
        this.games = res.data;

        if(this.games.length == 1){

            this.cat1 = this.games[0].category.title;
            this.categories.push(this.games[0].category_id);
        } else if(this.games.length == 2){
            this.cat1 = this.games[0].category.title;
            this.cat2 = this.games[1].category.title;

            this.categories.push(this.games[0].category_id);
            this.categories.push(this.games[1].category_id);
        }else if(this.games.length == 3){

            this.cat1 = this.games[0].category.title;
            this.cat2 = this.games[1].category.title;
            this.cat3 = this.games[2].category.title;

            this.categories.push(this.games[0].category_id);
            this.categories.push(this.games[1].category_id);
            this.categories.push(this.games[2].category_id);
        }else if(this.games.length == 4){
            this.cat1 = this.games[0].category.title;
            this.cat2 = this.games[1].category.title;
            this.cat3 = this.games[2].category.title;
            this.cat4 = this.games[3].category.title;

            this.categories.push(this.games[0].category_id);
            this.categories.push(this.games[1].category_id);
            this.categories.push(this.games[2].category_id);
            this.categories.push(this.games[3].category_id);
        }
        this.games.forEach(element => {
           element.category_id.forEach(elem => {
            this.words.push(elem);
           });
        });
      });
    },
    CheckResult(){

        if(this.list1.length != 0){
            // Первая категория
            for(let i = 0; i < this.list1.length; i++){
                for(let j = 0; j < this.categories[0].length; j++){
                    if(this.list1[i] != this.categories[0][j]){
                        let word = document.getElementById(`element_${this.list1[i].id}`)
                        word.classList.add('wrong');
                    }
                }
            }
            for(let i = 0; i < this.list1.length; i++){
                for(let j = 0; j < this.categories[0].length; j++){
                    if(this.list1[i] == this.categories[0][j]){
                        let word = document.getElementById(`element_${this.list1[i].id}`)
                        word.classList.add('right');
                    }
                }
            }
        }

        if(this.list2.length != 0){

            for(let i = 0; i < this.list2.length; i++){
                for(let j = 0; j < this.categories[1].length; j++){
                    if(this.list2[i] != this.categories[1][j]){
                        let word = document.getElementById(`element_${this.list2[i].id}`)
                        word.classList.add('wrong');
                    }
                }
            }
            for(let i = 0; i < this.list2.length; i++){
                for(let j = 0; j < this.categories[1].length; j++){
                    if(this.list2[i] == this.categories[1][j]){
                        let word = document.getElementById(`element_${this.list2[i].id}`)
                        word.classList.add('right');
                    }
                }
            }
        }

        if(this.list3.length != 0){

            for(let i = 0; i < this.list3.length; i++){
                for(let j = 0; j < this.categories[2].length; j++){
                    if(this.list3[i] != this.categories[2][j]){
                        let word = document.getElementById(`element_${this.list3[i].id}`)
                        word.classList.add('wrong');
                    }
                }
            }
            for(let i = 0; i < this.list3.length; i++){
                for(let j = 0; j < this.categories[2].length; j++){
                    if(this.list3[i] == this.categories[2][j]){
                        let word = document.getElementById(`element_${this.list3[i].id}`)
                        word.classList.add('right');
                    }
                }
            }
        }

        if(this.list4.length !=0){

            for(let i = 0; i < this.list4.length; i++){
                for(let j = 0; j < this.categories[3].length; j++){
                    if(this.list4[i] != this.categories[2][j]){
                        let word = document.getElementById(`element_${this.list4[i].id}`)
                        word.classList.add('wrong');
                    }
                }
            }
            for(let i = 0; i < this.list4.length; i++){
                for(let j = 0; j < this.categories[3].length; j++){
                    if(this.list4[i] == this.categories[3][j]){
                        let word = document.getElementById(`element_${this.list4[i].id}`)
                        word.classList.add('right');
                    }
                }
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
<style scoped>
.list-group{
    height: auto;
    min-height: 200px;
    display: flex;
    flex-direction: row;
    gap: 5px;
    flex-wrap: wrap;

}
.lg{
    display: flex;
    align-items: center;
    justify-content: center;
    height: auto;
    min-height: 50px !important;
}
.list-group-item{
    cursor:grab;
    width: 20%;
    height: auto;
    max-height: 70px;
}
.main{
    height: 100vh !important;
}

.wrong{
    transition: 0.2s;
    background-color: red;
    color: white;
}
.right{
    transition: 0.2s;
    background-color: green;
    color: white;
}
</style>
