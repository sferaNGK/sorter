<template>
    <div class="col-5 border">
        <div class="col-12 p-2 d-flex justify-content-start flex-column align-items-center" style="height:80vh">
            <div class="border col-6" style="background-color: #262626;">
                <h3 class="text-center text-white">{{ cat }}</h3>
            </div>
            <draggable
              class="list-group border p-2 h-100 container-fluid"
              group="people"
              itemKey="name"
              ghost-class="ghost"
              :empty-insert-threshhold="1500"
              :list="list1"
              @change="log"
            >
              <template #item="{ element }">
                <div class="list-group-item col-3 h-25" :id="`element_${element.id}`" :class="element.img ? 'noBorder' : ''">
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
        },
        length:{
            type: Number,
        }
    },
    methods:{
        log(event){
            if(this.children){
                this.list1.forEach(element => {
                     if(this.categories.includes(element)){
                         document.getElementById(`element_${element.id}`).classList.add('right');
                         document.getElementById(`element_${element.id}`).classList.remove('wrong');
                         document.getElementById(`element_${element.id}`).style.background = 'green';
                         document.getElementById(`element_${element.id}`).style.color = 'white';
                     } else{
                         document.getElementById(`element_${element.id}`).classList.add('wrong');
                         document.getElementById(`element_${element.id}`).classList.remove('right');
                         document.getElementById(`element_${element.id}`).style.background = 'red';
                         document.getElementById(`element_${element.id}`).style.color = 'white';
                     }
                });
             //    Придумать как передовать пропс через emit
                let wod = document.querySelectorAll('.right');
                if(wod.length == this.length){
                 console.log(123);
                }
            }
        }
    },
    computed:{
     list(){
      return [...this.list1];
     }
    },
  mounted(){
    this.link = link;
  }
}
</script>

