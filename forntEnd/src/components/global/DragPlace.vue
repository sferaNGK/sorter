<template>
    <div class="col-5 border">
        <div class="col-12 p-2 d-flex justify-content-center flex-column align-items-center">
            <div class="border col-6" style="background-color: #262626;">
                <h3 class="text-center text-white">{{ cat }}</h3>
            </div>
            <draggable
              class="list-group d-flex flex-row p-2"
              group="people"
              itemKey="name"
              :list="list1"
            >
              <template #item="{ element }">
                <div class="list-group-item border rounded text-center d-flex align-items-center justify-content-center" :id="`element_${element.id}`" :class="element.img ? 'noBorder' : ''">
                    <img v-if="element.img" :src="link + element.img" alt="" class="img-enter">
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
            type: Boolean,
            default: false
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
            let arr;
            this.list1.forEach(element => {
              word = document.getElementById(`element_${element.id}`);
            });
            word.classList.remove('right');
            word.classList.remove('wrong');
            for(let i = 0; i<this.list1.length; i++){
              if((this.categories.includes(this.list1[i]) && this.list1[i].title === word.textContent) || (this.categories.includes(this.list1[i]) && this.link + this.list1[i].img === word.firstChild.src)){
                    word.classList.add('right');
                    break;
                }
                else{
                    word.classList.add('wrong');
                }
                }
            },50)

        }
      },
      deep:true,
    },
  },
  mounted(){
    this.link = link;
  }
}
</script>

