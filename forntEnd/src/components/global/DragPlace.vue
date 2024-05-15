<template>
    <div class="dragplace col-6 border rounded" style="background-color: rgba(38, 38, 38, .2)">
        <div class="col-12 p-0 m-0 d-flex justify-content-start flex-column align-items-center" :class="two ? 'two' : three ? 'three' : four ? 'four' : ''">
            <div class="dragplaceCat rounded-top col-12 d-flex align-items-center justify-content-center" style="background-color: rgb(82, 99, 133); height:auto;">
                <h3 class="cat mt-1 d-flex align-items-center justify-content-center text-center text-white">{{ cat }}</h3>
            </div>
            <draggable
              class="list-group p-2 h-100 container-fluid mt-5"
              group="people"
              itemKey="name"
              ghost-class="ghost"
              :empty-insert-threshhold="1500"
              :list="list1"
              @change="log"
              @move="Moving"
            >
              <template #item="{ element }">
            <div class="list-group-item lgi col-12 rounded border" :id="`element_${element.id}`" :class="element.img ? 'bord' : '', three ? 'lg-min' : ''">
                    <img v-if="element.img" :src="link + element.img" alt="" class="img-enter">
                    <p class="w-100 h-100 p-0 m-0 d-flex align-items-center justify-content-center text-center" v-else>{{ element.title }}</p>
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
        ctLenght:0,
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
        },
        two:{
            type:Boolean
        },
        three:{
            type:Boolean
        },
        four:{
            type:Boolean
        },
    },
    methods:{
        log(event){
            if(event.removed){
                document.querySelector(".list-group-word").classList.remove("blockWord")
            }

            if(this.children){
                this.list1.forEach(element => {
                     if(this.categories.includes(element)){
                         document.getElementById(`element_${element.id}`).classList.add('right');
                         document.getElementById(`element_${element.id}`).classList.remove('wrong');
                         //document.getElementById(`element_${element.id}`).style.borderColor = 'green';
                        //  document.getElementById(`element_${element.id}`).style.color = 'white';
                     } else{
                         document.getElementById(`element_${element.id}`).classList.add('wrong');
                         document.getElementById(`element_${element.id}`).classList.remove('right');
                        //  document.getElementById(`element_${element.id}`).style.borderColor = 'red';
                        //  document.getElementById(`element_${element.id}`).style.color = 'white';
                     }
                });
             //    Придумать как передовать пропс через emit
                let wod = document.querySelectorAll('.right');
                if(wod.length == this.length){
                    this.$emit("changeValue", wod.length);
                }
            }
        },
        Moving(event){
            console.log(1);

                document.querySelector(".list-group-word").classList.add("blockWord");

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

