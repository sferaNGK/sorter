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
                <div class="list-group-item border rounded text-center">
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
        words:{
            type:Array
        }
    }
}
</script>