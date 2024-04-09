<template>
    <div class="col-12 d-flex align-items-end justify-content-center" style="position: absolute;">
        <div class="w-50 h-50 border rounded p-5">
            <draggable
              class="list-group lg"
              :list="words"
              group="people"
              itemKey="name"
            >
              <template #item="{ element }">
                <div class="list-group-item border rounded text-center" :class="element.img ? 'noBorder' : ''">
                    <img v-if="element.img" :src="link +element.img" alt="" class="img">
                    <p v-else>{{ element.title }}</p>
                </div>
              </template>
        </draggable>
      </div>
    </div>
</template>

<script>
import draggable from "vuedraggable"
import { link } from "@/main";
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
        words:{
            type:Array
        }
    }
}
</script>