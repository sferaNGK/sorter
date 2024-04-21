<template>
    <div class="d-flex align-items-center justify-content-center border p-5" style=" position:absolute; margin-top:20%; margin-left:43%; z-index:500;   background-color: #262626; width:15%; height:20%">
        <div>
            <draggable
              class="list-group d-flex justify-content-center align-items-center w-100 h-50 p-2"
              :list="words"
              group="people"
              itemKey="name"
            >
               <!-- style="max-height:100%" -->
              <template #item="{ element }">
                <div class="list-group-item lg rounded text-center text-white" style=" background-color: rgb(73, 73, 73);" :id="`element_${element.id}`" :class="element.img ? 'noBorder' : ''">
                    <img v-if="element.img" :src="link + element.img" alt="" class="img">
                    <p v-else>{{ element.title }}</p>
                </div>
              </template>
        </draggable>
      </div>
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
