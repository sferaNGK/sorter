<?php $__env->startSection('content'); ?>
<div class="container" id="MainCreate">
    <div class="container-fluid mb-5 d-flex align-items-center justify-content-center gap-5 mt-5">
        <button class="btn w-50 fs-4 btn-primary" @click="clicker = 1">Категории</button>
        <button class="btn w-50 fs-4 btn-primary" @click="clicker = 2">Слова</button>
        <button class="btn w-50 fs-4 btn-primary" @click="clicker = 3">Стили</button>
    </div>

    
    <div class="container" v-if="clicker == 1">
        <div class="d-flex flex-row gap-5">
            <h5>Добавить Категории</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCat">Добавить</button>

            <div class="modal fade" id="exampleModalCat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="p-2" v-if="message != ''">
                        <div class="alert alert-success mt-2">
                              {{ message }}
                        </div>
                    </div>
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить Категорию</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="AddGameCat" id="add_form_cat">
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
        <div>
            <table class="table mt-5">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Действие</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="cat in categories">
                    <th scope="row">{{ cat.id }}</th>
                    <td>{{ cat.category.title }}</td>
                    <td>
                        <button class="btn btn-primary me-1" data-bs-toggle="modal" :data-bs-target="`#exampleModalCat_${cat.id}`">Редактировать</button>

                        <div class="modal fade" :id="`exampleModalCat_${cat.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="p-2" v-if="message != ''">
                                    <div class="alert alert-success mt-2">
                                          {{ message }}
                                    </div>
                                </div>
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение категории</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form @submit.prevent="EditGameCat(cat.category.id)" :id="`edit_form_${cat.category.id}`">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleInputTitle1" class="form-label">Назавние категории</label>
                                            <input name="title" type="text" :value="cat.category.title" class="form-control" id="exampleInputTitle1">
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

                        <button class="btn btn-danger" @click="DeleteGameCat(cat.category.id)">Удалить</button>
                    </td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>

    
    <div class="container" v-if="clicker == 2">
        <div class="d-flex flex-row gap-5">
            <h5>Добавить Слова</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalWord">Добавить</button>

            <div class="modal fade" id="exampleModalWord" tabindex="-1" aria-labelledby="exampleModalLabelWord" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="p-2" v-if="message != ''">
                        <div class="alert alert-success mt-2">
                              {{ message }}
                        </div>
                    </div>
                    <div class="modal-header">
                      <h1 class="modal-title fs-5">Добавить Слово</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="AddGameWord" id="add_form_word">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="select" class="form-label" style="color: black !important;">Выберите что вы хотите добавить:</label>
                                <select class="form-select" v-model="SelectTypeFile">
                                    <option selected disabled>Выберите наполнение игры</option>
                                    <option value="0">Текст</option>
                                    <option value="1">Картинки</option>
                                </select>
                            </div>
                            <div class="mb-3" v-if="SelectTypeFile == 0">
                                <label for="exampleInputTitle1" class="form-label">Введите слово</label>
                                <input name="title" type="text" class="form-control" id="exampleInputTitle1">
                            </div>
                            <div class="mb-3" v-if="SelectTypeFile == 1">
                                <label for="exampleInputImg1" class="form-label">Вставте фото</label>
                                <input name="img" type="file" class="form-control" id="exampleInputImg1">
                            </div>
                            <div class="mb-3">
                                <label for="select" class="form-label" style="color: black !important;">Выберите категорию</label>
                                <select id="type_id" name="category" class="form-select">
                                    <option selected disabled>Выберите категорию</option>
                                    <option v-for="category in categories" :value="category.category.id">
                                        {{ category.category.title }}
                                    </option>
                                </select>
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
        <div>
            <table class="table mt-5">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Слово</th>
                    <th scope="col">Изображение</th>
                    <th scope="col">Категория</th>
                    <th scope="col">Действие</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="word in words">
                    <th scope="row">{{ word.id }}</th>
                    <td>{{ word.title }}</td>
                    <td><img :src="word.img" style="width: 100px" alt=""></td>
                    <td>{{ word.category.title }}</td>
                    <td>
                        <button class="btn btn-primary me-1" data-bs-toggle="modal" :data-bs-target="`#exampleModalWord_${word.id}`">Редактировать</button>

                        <div class="modal fade" :id="`exampleModalWord_${word.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="p-2" v-if="message != ''">
                                    <div class="alert alert-success mt-2">
                                          {{ message }}
                                    </div>
                                </div>
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение Слов</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form @submit.prevent="EditGameWord(word.id)" :id="`edit_form_word_${word.id}`">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="select" class="form-label" style="color: black !important;">Выберите что вы хотите добавить:</label>
                                            <select class="form-select" v-model="SelectTypeFile">
                                                <option selected disabled>Выберите наполнение игры</option>
                                                <option value="0">Текст</option>
                                                <option value="1">Картинки</option>
                                            </select>
                                        </div>
                                        <div class="mb-3" v-if="SelectTypeFile == 0">
                                            <label for="exampleInputTitle1" class="form-label">Назавние Слова</label>
                                            <input name="title" type="text" :value="word.title" class="form-control" id="exampleInputTitle1">
                                        </div>
                                        <div class="mb-3"  v-if="SelectTypeFile == 1">
                                            <label for="exampleInputImg1" class="form-label">Вставте фото</label>
                                            <input name="img" type="file" class="form-control" id="exampleInputImg1">
                                        </div>
                                        <div class="mb-3">
                                            <label for="select" class="form-label" style="color: black !important;">Выберите категорию</label>
                                            <select id="type_id" name="category" class="form-select">
                                                <option v-for="category in categories" :value="category.category.id" :v-if="category.category.id == word.category_id">
                                                    {{ category.category.title }}
                                                </option>
                                            </select>
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

                        <button class="btn btn-danger" @click="DeleteGameWord(word.id)">Удалить</button>
                    </td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>

    
    <div class="container" v-if="clicker == 3">
        <div class="d-flex flex-row gap-5">
            <h5>Добавить|Выбрать Стиль</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalStyleAdd">Выбрать стиль игре</button>

            <div class="modal fade" id="exampleModalStyleAdd" tabindex="-1" aria-labelledby="exampleModalLabelStyle" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="p-2" v-if="message != ''">
                        <div class="alert alert-success mt-2">
                              {{ message }}
                        </div>
                    </div>
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabelStyle">Добавить Стиль</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="ChoseStyleGame" id="chose_form_style">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputCss1" class="form-label">Выберите стиль</label>
                                <select class="form-control mt-2 mb-2" name="style">
                                    <option v-for="style in stylesAll" :value="style.id">{{ style.title }}</option>
                                </select>
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

            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalStyle">Добавить стиль</button>
            <div class="modal fade" id="exampleModalStyle" tabindex="-1" aria-labelledby="exampleModalStyle" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="p-2" v-if="message != ''">
                        <div class="alert alert-success mt-2">
                              {{ message }}
                        </div>
                    </div>
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalStyle">Выберите Стиль</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="AddGameStyle" id="add_form_style">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputTitle1" class="form-label">Введите название</label>
                                <input name="title" type="text" class="form-control" id="exampleInputTitle1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputImg1" class="form-label">Вставте файл</label>
                                <input name="css" type="file" class="form-control" id="exampleInputImg1">
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
        <div>
            <select class="form-control mt-5 w-50" v-model="styleStatus">
                <option value="0">Все стили</option>
                <option value="1">Стиль выбранной игры</option>
            </select>
            <table class="table mt-5" v-if="styleStatus == 1">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Действие</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="style in styles">
                    <th scope="row">{{ style.style.id }}</th>
                    <td>{{ style.style.title }}</td>
                    <td>
                        <button class="btn btn-primary me-1" data-bs-toggle="modal" :data-bs-target="`#exampleModalStyle_${style.style.id}`">Редактировать</button>

                        <div class="modal fade" :id="`exampleModalStyle_${style.style.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="p-2" v-if="message != ''">
                                    <div class="alert alert-success mt-2">
                                          {{ message }}
                                    </div>
                                </div>
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение Стиля</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form @submit.prevent="EditGameStyle(style.style.id)" :id="`edit_form_style_${style.style.id}`">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleInputTitle1" class="form-label">Назавние Стиля</label>
                                            <input name="title" type="text" :value="style.style.title" class="form-control" id="exampleInputTitle1">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputImg1" class="form-label">Вставте файл</label>
                                            <input name="img" type="file" class="form-control" id="exampleInputImg1">
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

                        <button class="btn btn-danger" @click="DeleteGameStyle(style.style.id)">Удалить</button>
                    </td>
                  </tr>
                </tbody>
            </table>
            <table class="table mt-5" v-if="styleStatus == 0">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Действие</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="style in stylesAll">
                    <th scope="row">{{ style.id }}</th>
                    <td>{{ style.title }}</td>
                    <td>
                        <button class="btn btn-primary me-1" data-bs-toggle="modal" :data-bs-target="`#exampleModalStyle_${style.id}`">Редактировать</button>

                        <div class="modal fade" :id="`exampleModalStyle_${style.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="p-2" v-if="message != ''">
                                    <div class="alert alert-success mt-2">
                                          {{ message }}
                                    </div>
                                </div>
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение Стиля</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form @submit.prevent="EditGameStyle(style.id)" :id="`edit_form_style_${style.id}`">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleInputTitle1" class="form-label">Назавние Стиля</label>
                                            <input name="title" type="text" :value="style.title" class="form-control" id="exampleInputTitle1">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputImg1" class="form-label">Вставте файл</label>
                                            <input name="img" type="file" class="form-control" id="exampleInputImg1">
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

                        <button class="btn btn-danger" @click="DeleteGameStyle(style.id)">Удалить</button>
                    </td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const app = {
        data() {
            return {
                message:'',
                categories:[],
                words:[],
                styles:[],
                stylesAll:[],
                clicker:1,
                styleStatus:0,
                SelectTypeFile:0,
            }
        },
        methods: {
            // Категории
            async GetCategoriesGame(){
                let id = `<?php echo e($game->id); ?>`;
                const response = await fetch('<?php echo e(route('GetCategoriesGame')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                        'content-type':'application/json',
                    },
                    body:JSON.stringify({id:id})
                });
                if(response.status == 200){
                    this.categories = await response.json();
                }
            },
            async EditGameCat(id){
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
                if(response.status == 200){
                    this.message = await response.json();
                    setTimeout(() => {
                        this.message = '';
                    }, 5000);
                }
                this.GetCategoriesGame();
            },
            async DeleteGameCat(id){
                const response = await fetch('<?php echo e(route('DeleteCategory')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                        'content-type':'application/json'
                    },
                    body:JSON.stringify({id:id})
                });
                this.GetCategoriesGame();
            },
            async AddGameCat(){
                let id = `<?php echo e($game->id); ?>`;
                let form = document.getElementById('add_form_cat');
                let form_data = new FormData(form);
                form_data.append('id', id);
                const response = await fetch('<?php echo e(route('AddGameCategory')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                    },
                    body:form_data
                });
                if(response.status == 200){
                    this.message = await response.json();
                    setTimeout(() => {
                        this.message = '';
                    }, 5000);
                }
                this.GetCategoriesGame();
            },

            // Слова
            async GetWordsGame(){
                let id = `<?php echo e($game->id); ?>`;
                const response = await fetch('<?php echo e(route('GetWordsGame')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                        'content-type':'application/json',
                    },
                    body:JSON.stringify({id:id})
                });
                if(response.status == 200){
                    this.words = await response.json();
                    this.words.sort((a,b)=>a.id - b.id).reverse();
                }
            },
            async AddGameWord(){
               let id = `<?php echo e($game->id); ?>`;
                let form = document.getElementById('add_form_word');
                let form_data = new FormData(form);
                form_data.append('id', id);
                const response = await fetch('<?php echo e(route('AddGameWord')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                    },
                    body:form_data
                });
                if(response.status == 200){
                    this.message = await response.json();
                    setTimeout(() => {
                        this.message = '';
                    }, 5000);
                }
                this.GetWordsGame();
            },
            async EditGameWord(id){
                let form = document.getElementById(`edit_form_word_${id}`);
                let form_data = new FormData(form);
                form_data.append('id',JSON.stringify(id));
                const response = await fetch('<?php echo e(route('EditWord')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                    },
                    body:form_data
                });
                if(response.status == 200){
                    this.message = await response.json();
                    setTimeout(() => {
                        this.message = '';
                    }, 5000);
                }
                this.GetWordsGame();
            },
            async DeleteGameWord(id){
                const response = await fetch('<?php echo e(route('DeleteWord')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                        'content-type':'application/json'
                    },
                    body:JSON.stringify({id:id})
                });
                this.GetWordsGame();
            },


            // Стили
            async ChoseStyleGame(){
                let id = `<?php echo e($game->id); ?>`;
                let form = document.getElementById('chose_form_style');
                let form_data = new FormData(form);
                form_data.append('id', id);
                const response = await fetch('<?php echo e(route('ChoseGameStyle')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                    },
                    body:form_data
                });
                if(response.status == 200){
                    this.message = await response.json();
                    setTimeout(() => {
                        this.message = '';
                    }, 5000);
                }
                this.GetStylesGame();
            },
            async GetStylesGame(){
                let id = `<?php echo e($game->id); ?>`;
                const response = await fetch('<?php echo e(route('GetStylesGame')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                        'content-type':'application/json',
                    },
                    body:JSON.stringify({id:id})
                });
                if(response.status == 200){
                    this.styles = await response.json();
                }
            },
            async GetStylesGameAll(){
                const response = await fetch('<?php echo e(route('GetStyle')); ?>');
                this.stylesAll = await response.json();
            },
            async AddGameStyle(){
               let id = `<?php echo e($game->id); ?>`;
                let form = document.getElementById('add_form_style');
                let form_data = new FormData(form);
                form_data.append('id', id);
                const response = await fetch('<?php echo e(route('AddGameStyle')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                    },
                    body:form_data
                });
                if(response.status == 200){
                    this.message = await response.json();
                    setTimeout(() => {
                        this.message = '';
                    }, 5000);
                }
                this.GetStylesGame();
            },
            async EditGameStyle(id){
                let form = document.getElementById(`edit_form_style_${id}`);
                let form_data = new FormData(form);
                form_data.append('id',JSON.stringify(id));
                const response = await fetch('<?php echo e(route('EditStyle')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                    },
                    body:form_data
                });
                if(response.status == 200){
                    this.message = await response.json();
                    setTimeout(() => {
                        this.message = '';
                    }, 5000);
                }
                this.GetStylesGame();
            },
            async DeleteGameStyle(id){
                const response = await fetch('<?php echo e(route('DeleteStyle')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                        'content-type':'application/json'
                    },
                    body:JSON.stringify({id:id})
                });
                this.GetStylesGame();
            },
        },
        mounted() {
            this.GetCategoriesGame();
            this.GetWordsGame();
            this.GetStylesGame();
            this.GetStylesGameAll();

        },
    }
    Vue.createApp(app).mount('#MainCreate');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminLayout.appAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\onixc\Downloads\sorter\resources\views/admin/games/create.blade.php ENDPATH**/ ?>