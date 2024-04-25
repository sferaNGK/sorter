@extends('admin.index')
@section('contented')
<div class="container mt-5" id="Categories">
    <div class="container d-flex flex-row gap-5">
        <h5>Слова</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Добавить слово
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление слова</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="AddWord" id="add_form" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputTitle1" class="form-label">Введите слово</label>
                            <input name="title" type="text" class="form-control" id="exampleInputTitle1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputImg1" class="form-label">Вставте фото</label>
                            <input name="img" type="file" class="form-control" id="exampleInputImg1">
                        </div>
                        <div class="mb-3">
                            <label for="select" class="form-label" style="color: black !important;">Выберите категорию</label>
                            <select id="type_id" name="category" class="form-select">
                                <option selected disabled>Выберите категорию</option>
                                <option v-for="category in categories" :value="category.id">
                                    @{{ category.title }}
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
    <div class="container p-5">
        <input type="text" placeholder="Введите категорию интересующего вас слова/изображения" v-model="searchValue" class="form-control">
    </div>
    <div class="container mt-5">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Название</th>
                <th scope="col">Категория</th>
                <th scope="col">photo</th>
                <th scope="col">Действие</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="word in Search">
                <th scope="row">@{{ word.id }}</th>
                <td>@{{ word.title }}</td>
                <td>@{{ word.category.title }}</td>
                <td><img :src="word.img" style="width: 50px;"></td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" :data-bs-target="`#exampleModal_${word.id}`">
                        Редактировать
                      </button>

                    <div class="modal fade" :id="`exampleModal_${word.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение Слова/Изображения</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form @submit.prevent="EditWord(word.id)" :id="`edit_form_${word.id}`">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputTitle1" class="form-label">Назавние</label>
                                        <input name="title" type="text" :value="word.title" class="form-control" id="exampleInputTitle1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputImg1" class="form-label">Вставте фото</label>
                                        <input name="img" type="file" class="form-control" id="exampleInputImg1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="select" class="form-label" style="color: black !important;">Выберите категорию</label>
                                        <select id="type_id" name="category" class="form-select">
                                            <option v-for="category in categories" :value="category.id">
                                                @{{ category.title }}
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
                    <button class="btn btn-danger ms-2" @click="DeleteWord(word.id)">Удалить</button>
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
                words:[],
                searchValue:'',
            }
        },
        methods:{
            async AddWord(){
                let form = document.getElementById('add_form');
                let form_data = new FormData(form);
                const response = await fetch('{{route('AddWord')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                    },
                    body:form_data
                });
                this.getWord();
            },
            async EditWord(id){
                let form = document.getElementById(`edit_form_${id}`);
                let form_data = new FormData(form);
                form_data.append('id',JSON.stringify(id));
                const response = await fetch('{{route('EditWord')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                    },
                    body:form_data
                });
                this.getWord();
            },
            async DeleteWord(id){
                const response = await fetch('{{route('DeleteWord')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        'content-type':'application/json'
                    },
                    body:JSON.stringify({id:id})
                });
                this.getWord();
            },
            async getCategory(){
                let response_categ = await fetch('{{ route('GetCategories') }}');
                this.categories = await response_categ.json();
            },
            async getWord(){
                let response_word = await fetch('{{ route('GetWord') }}');
                this.words = await response_word.json();
            }
        },
        computed:{
            Search(){
                // console.log(this.words[0].category.title);
                if(this.searchValue == ''){
                    return [...this.words];
                } else{
                    return [...this.words].filter(words=>words.category.title.toLowerCase().includes(this.searchValue.toLowerCase()));
                }
            }
        },
        mounted(){
            this.getCategory();
            this.getWord();
        }
    }
    Vue.createApp(app).mount('#Categories');
</script>
@endsection
