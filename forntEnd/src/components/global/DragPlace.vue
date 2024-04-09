<template>
    <div class="col-6">
        <div class="col-12 h-100">
            <h3 class="text-center">{{ cat }}</h3>
            <draggable
              class="list-group p-2 border rounded mt-3"
              group="people"
              itemKey="name"
              :list="list1"
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
import { computed } from "vue";
import draggable from "vuedraggable"
export default {
    components: {
        draggable
    },
    data(){
      return{
        link:'http://127.0.0.1:8000',
      }
    },
    props:{
        list1:{
            type:Array
        },
        cat:{
            type:String
        },
        children:{
            type: {
                type: Boolean,
                default: false
            }
        },
        categories:{
            type:Array
        }
    },
    computed:{
     list(){
      return [...this.list1];
     }
    },
    watch:{
    list:{
      handler(newVal, oldVal){
    
        if(this.children){
         
          setTimeout(()=>{
            let word;
            this.list1.forEach(element => {
              word = document.getElementById(`element_${element.id}`);
            });
            
            for(let i = 0; i<this.list1.length; i++){
              if((this.categories.includes(this.list1[i]) && this.list1[i].title === word.textContent) || (this.categories.includes(this.list1[i]) && 'http://127.0.0.1:8000' + this.list1[i].img === word.firstChild.src)){
                    word.classList.add('right');
                   break;
                }
                }
            },50)

        }
      },
      deep:true,
    },
  },
}
</script>