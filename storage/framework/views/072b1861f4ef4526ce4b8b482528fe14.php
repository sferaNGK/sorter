<?php $__env->startSection('contented'); ?>
<div class="container mt-5" id="Categories">
    <div class="container d-flex flex-row gap-5">
        <h5>Игры</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Добавить Игру
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление Игры</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="AddGame" id="add_form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputTitle1" class="form-label">Назавние Игры</label>
                            <input name="title" type="text" class="form-control" id="exampleInputTitle1">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                      <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
    </div>
    <div class="container mt-5">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Название</th>
                <th scope="col">Действие</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="game in games">
                <th scope="row">{{ game.id }}</th>
                <td>{{ game.title }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" :data-bs-target="`#exampleModal_${game.id}`">
                        Редактировать
                      </button>

                    <div class="modal fade" :id="`exampleModal_${game.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение категории</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form @submit.prevent="EditGame(game.id)" id="edit_form">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputTitle1" class="form-label">Назавние Игры</label>
                                        <input name="title" type="text" :value="game.title" class="form-control" id="exampleInputTitle1">
                                    </div>
                                    <div class="mb-3">
                                        <div id="inputs_games">
                                            <button type="button" @click="add_game_input" class="btn btn-info text-white">добавить категории</button>
                                            <div v-if="games_new.length != 0">
                                                <label for="exampleInputEmail1" class="form-label">Введите подкатегорию</label>
                                                <select class="form-control mt-2 mb-2" v-for="game in games_new" name="games[]">
                                                    <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                  <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    <button class="btn btn-danger ms-2" @click="DeleteGame(game.id)">Удалить</button>
                </td>
              </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    const app = {
        data(){
            return{
                errors: [],
                games:[],
                message: '',
                categories:[],
                games_new:[],
            }
        },
        methods:{
            async AddGame(){
                let form = document.getElementById('add_form');
                let form_data = new FormData(form);
                const response = await fetch('<?php echo e(route('AddGame')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                    },
                    body:form_data
                });
                this.getCategory();
            },
            async EditGame(id){
                let form = document.getElementById('edit_form');
                let form_data = new FormData(form);
                form_data.append('id',JSON.stringify(id));
                const response = await fetch('<?php echo e(route('EditGame')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                    },
                    body:form_data
                });
                this.getGames();
            },
            async DeleteGame(id){
                const response = await fetch('<?php echo e(route('DeleteGame')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                        'content-type':'application/json'
                    },
                    body:JSON.stringify({id:id})
                });
                this.getGames();
            },
            async getGames(){
                let response_categ = await fetch('<?php echo e(route('GetGames')); ?>');
                this.games = await response_categ.json();
            },
            async getCategory(){
                let response_categ = await fetch('<?php echo e(route('GetCategories')); ?>');
                this.categories = await response_categ.json();
            },
            add_game_input(){
                this.games_new.push('');
            }
        },
        mounted(){
            this.getGames();
            this.getCategory();
        }
    }
    Vue.createApp(app).mount('#Categories');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vue\sorter\resources\views/admin/games/index.blade.php ENDPATH**/ ?>