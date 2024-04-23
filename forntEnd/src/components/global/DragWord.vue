<template>
    <div class="d-flex align-items-center justify-content-center" :class="adult ? 'blockBtn' : ''" style="position: absolute;
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
            style="background-color:#262627;"
            >
               <!-- style="max-height:100%" -->
              <template #item="{ element }">
                <div class="list-group-item-word rounded text-center text-white" style=" background-color: rgb(73, 73, 73);" :id="`element_${element.id}`" :class="element.img ? 'noBorder' : ''">
                    <img v-if="element.img" :src="link + element.img" alt="" class="img">
                    <p v-else>{{ element.title }}</p>
                </div>
              </template>
        </draggable>
    </div>
</template>

<script>
import draggable from "vuedraggable"
import { link } from "@/main"
export default {
    components: {
        draggable
    },
    data(){
      return{
        link:'',
        y:'',
      }
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
            console.log(event);
        }
    },
    watch:{
    y:{
        handler(){
            if(this.y == 1){
                let word = this.words[0];
                for(let i = 0; this.words.length; i++){
                    if(this.words[i] === undefined){
                        break;
                    }
                    else if(this.words[i].id != word.id){
                        word = document.getElementById(`element_${this.words[i].id}`);
                        word.classList.add('d-none');
                    }

                }
            }
        },
        deep: true
    }
},
mounted(){
    this.y = '1';
    this.link = link;
}
}
</script>
