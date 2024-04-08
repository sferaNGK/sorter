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
                <div class="list-group-item border rounded text-center" :id="`element_${element.id}`">
                    <img v-if="element.img" :src="element.img" alt="">
                    <p v-else>{{ element.title }}</p>
                </div>
              </template>
            </draggable>
        </div>
    </div>
</template>

<script>
import draggable from "vuedraggable"
export default {
    components: {
        draggable
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
    watch:{
    list1:{
      handler(){
        if(this.children){
            setTimeout(()=>{
                let word;
                this.list1.forEach(element => {
                    word = document.getElementById(`element_${element.id}`);
                });
                console.log(word);
                for(let i = 0; i<this.list1.length; i++){
                  if(this.categories.includes(this.list1[i]) && this.list1[i].title === word.textContent){
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
      deep:true
    },
  },
}
</script>