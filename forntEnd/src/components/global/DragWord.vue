<template>
    <div class="wordblock d-flex align-items-center justify-content-center" :class="adult ? 'blockBtn' : ''" style="position: absolute;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    text-align: center; z-index:500; width:200px; height:200px;">
            <draggable
              class="list-group-word border p-2 w-100"
              :list="words"
              group="people"
              itemKey="name"
            style="background-color: rgba(38, 38, 38, .2);"
            @change="log"
            >
               <!-- style="max-height:100%" -->
              <template #item="{ element }">
                <div class="list-group-item-word rounded text-center d-flex align-items-center justify-content-center text-white" style=" background-color: white;" :id="`element_${element.id}`" :class="element.img ? 'noBorder' : ''">
                    <img v-if="element.img" :src="link + element.img" alt="" class="img">
                    <p class="w-100 h-100 mt-3 text-center text-black" v-else>{{ element.title }}</p>
                </div>
              </template>
        </draggable>
    </div>
</template>

<script>
import draggable from "vuedraggable"
import { link } from "@/main"
export default {
     data(){
      return{
        link:'',
      }
    },
    components: {
        draggable
    },
    props:{
        words:{
            type:Array
        },
        adult:{
            type:Boolean
        }

    },
    methods:{
        log(event){
           for(let i = 0; i < this.words.length; i++){
                if(this.words[i] != this.words[0]){
                    let word = document.getElementById(`element_${this.words[i].id}`);
                    word.classList.add('d-none');
                }
           }
        },
        loading(){
            for(let i = 0; i < this.words.length; i++){
                if(this.words[i] != this.words[0]){
                    let word = document.getElementById(`element_${this.words[i].id}`);
                    word.classList.add('d-none');
                }
           }
        }
    },
mounted(){
    this.loading();
    this.link = link;
}
}
</script>
