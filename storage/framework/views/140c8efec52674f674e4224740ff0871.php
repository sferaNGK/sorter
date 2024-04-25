<?php $__env->startSection('contented'); ?>
<div class="container mt-5" id="Categories">
    <div class="container d-flex flex-row gap-5">
        <h5>Категории</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Добавить категорию
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление категории</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="AddCategory" id="add_form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputTitle1" class="form-label">Назавние категории</label>
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
              <tr v-for="category in categories">
                <th scope="row">{{ category.id }}</th>
                <td>{{ category.title }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" :data-bs-target="`#exampleModal_${category.id}`">
                        Редактировать
                      </button>

                    <div class="modal fade" :id="`exampleModal_${category.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение категории</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form @submit.prevent="EditCategory(category.id)" :id="`edit_form_${category.id}`">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputTitle1" class="form-label">Назавние категории</label>
                                        <input name="title" type="text" :value="category.title" class="form-control" id="exampleInputTitle1">
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
                    <button class="btn btn-danger ms-2" @click="DeleteCategory(category.id)">Удалить</button>
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
                categories:[],
                message: '',
            }
        },
        methods:{
            async AddCategory(){
                let form = document.getElementById('add_form');
                let form_data = new FormData(form);
                const response = await fetch('<?php echo e(route('AddCategory')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                    },
                    body:form_data
                });
                this.getCategory();
            },
            async EditCategory(id){
                let form = document.getElementById(`edit_form_${id}`);
                let form_data = new FormData(form);
                form_data.append('id',JSON.stringify(id));
                const response = await fetch('<?php echo e(route('EditCategory')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                    },
                    body:form_data
                });
                this.getCategory();
            },
            async DeleteCategory(id){
                const response = await fetch('<?php echo e(route('DeleteCategory')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                        'content-type':'application/json'
                    },
                    body:JSON.stringify({id:id})
                });
                this.getCategory();
            },
            async getCategory(){
                let response_categ = await fetch('<?php echo e(route('GetCategories')); ?>');
                this.categories = await response_categ.json();
            }
        },
        mounted(){
            this.getCategory();
        }
    }
    Vue.createApp(app).mount('#Categories');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\onixc\Downloads\sorter\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>