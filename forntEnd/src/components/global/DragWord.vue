<template>
    <div class="col-12 d-flex align-items-end justify-content-center" style="position: absolute;">
        <div class="w-50 h-25 p-5">
            <draggable
              class="list-group lg"
              :list="words"
              group="people"
              itemKey="name"
            >
              <template #item="{ element }">
                <div class="list-group-item border rounded text-center" :id="`element_${element.id}`" :class="element.img ? 'noBorder' : ''">
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
        link:'http://127.0.0.1:8000',
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
}
}
</script>
