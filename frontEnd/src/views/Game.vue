<template>
  <div class="row col-12">
    <div class="col-4">
      <h3>{{ cat1 }}</h3>

      <draggable
        id="first"
        data-source="juju"
        :list="list"
        class="list-group"
        group="a"
        item-key="name"
      >
        <template #item="{ element }">
          <div class="list-group-item">
            {{ element.id }}
          </div>
        </template>
      </draggable>
    </div>

    <div class="col-4">
      <h3>{{ cat2 }}</h3>

      <draggable
        id="first"
        data-source="juju"
        :list="list3"
        class="list-group"
        group="a"
        item-key="name"
      >
        <template #item="{ element }">
          <div class="list-group-item">
            {{ element.id }}
          </div>
        </template>

      </draggable>
    </div>

  </div>
  <div class="col-4 mt-5">

    <draggable :list="games" class="list-group" group="a" item-key="name">
      <template #item="{ element }">
        <div class="list-group-item item">
          {{ element.id }}
        </div>
      </template>

    </draggable>
  </div>
</template>

<script>
import axios from 'axios'
import draggable from "vuedraggable";
let id = 1;
export default {
  components: {
    draggable
  },
  data() {
    return {
      list: [
      
      ],
      list2: [

      ],
      list3: [
      ],
      games:[],
      gmae:[],
      cat1:'',
      cat2:'',
      categories:{
        arr:[],
      }
    };
  },
  watch:{
    list:{
      handler(){
        console.log(1);
      },
      deep:true
    }
  },
  methods: {
    getGames(id){
      axios.get(`http://127.0.0.1:8000/api/game/${id}`).then(res => {
        this.games = res.data;
        this.cat1 = this.games[0].category.title;
        this.cat2 = this.games[1].category.title;
        this.categories.arr.push(this.games[0].category.id);
        this.categories.arr.push(this.games[1].category.id)
      });
    },
  },
  mounted() {
    this.getGames(this.$route.params.id);
  },
};
</script>
<style scoped></style>