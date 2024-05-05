@extends('admin.adminLayout.appAdmin')
@section('content')
<div class="container-fluid" id="AdminPage">
    {{-- search --}}
    <div class="container mt-5">
        <input type="text" placeholder="Введите название интересующей вас игры" v-model="searchValue" class="form-control">
    </div>

    {{-- Add Game --}}
    <div class="container mt-5 d-flex flex-row gap-5">
        <h5>Добавить игру</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Добавить</button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="p-2" v-if="message != ''">
                    <div class="alert alert-success mt-2">
                          @{{ message }}
                    </div>
                </div>
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление игры</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="AddGame" id="add_form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputTitle1" class="form-label">Назавние игры</label>
                            <input name="title" type="text" class="form-control" id="exampleInputTitle1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputTitle1" class="form-label">Описание игры</label>
                            <textarea name="description" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <select name="style" class="form-control">
                                <option selected disabled>Выберите стиль для игры</option>
                                <option v-for="style in stylesAll" :value="style.id">@{{ style.title }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <select name="game" class="form-control">
                                <option selected disabled>Выберите режим игры</option>
                                <option value="false">Без кнопки</option>
                                <option value="true">С кнопкой</option>
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

    {{-- Container --}}
    <div class="container d-flex flex-row  gap-5 mt-5">
        <div class="d-flex flex-row flex-wrap gap-5">
            <div class="card" style="width:18rem" v-for="game in Search">
                <div class="card-body">
                  <h5 class="card-title">@{{ game.title }}</h5>
                </div>
                <div class="card-footer d-flex flex-row flex-wrap">

                    <a href="#" class="btn btn-success me-2" @click="show_page_game(game.id)">Открыть</a>

                    <a class="btn btn-primary" data-bs-toggle="modal" :data-bs-target="`#exampleModal_${game.id}`">Редактировать</a>
                    <div class="modal fade" :id="`exampleModal_${game.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="p-2" v-if="message != ''">
                                <div class="alert alert-success mt-2">
                                      @{{ message }}
                                </div>
                            </div>
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение категории</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form @submit.prevent="EditGame(game.id)" :id="`edit_form_${game.id}`">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputTitle1" class="form-label">Назавние Игры</label>
                                        <input name="title" type="text" :value="game.title" class="form-control" id="exampleInputTitle1">
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

                    <a @click="DeleteGame(game.id)" class="btn btn-danger mt-2">Удалить</a>
                </div>
              </div>
        </div>
        </div>
</div>
<script>
    const app = {
        data() {
            return {
                message:'',
                searchValue:'',
                games:[],
                stylesAll:[],
            }
        },
        methods: {
            async GetStylesGameAll(){
                const response = await fetch('{{route('GetStyle')}}');
                this.stylesAll = await response.json();
            },
            async GetGames(){
                let games = await fetch('{{ route('GetGames') }}');
                this.games = await games.json();
            },
            async AddGame(){
                let form = document.getElementById('add_form');
                let form_data = new FormData(form);
                const response = await fetch('{{route('AddGameMain')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                    },
                    body:form_data
                });
                if(response.status == 200){
                    this.message = await response.json();
                    setTimeout(() => {
                        this.message = '';
                    }, 5000);
                }
                this.GetGames();
            },
            async EditGame(id){
                let form = document.getElementById(`edit_form_${id}`);
                let form_data = new FormData(form);
                form_data.append('id',JSON.stringify(id));
                const response = await fetch('{{route('EditGameMain')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                    },
                    body:form_data
                });
                if(response.status == 200){
                    this.message = await response.json();
                    setTimeout(() => {
                        this.message = '';
                    }, 5000);
                }
                this.GetGames();
            },
            async DeleteGame(id){
                const response = await fetch('{{route('DeleteGame')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        'content-type':'application/json'
                    },
                    body:JSON.stringify({id:id})
                });
                this.GetGames();
            },
            async show_page_game(id){
                const response = await fetch('{{ route('show_page_game') }}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        'content-type':'application/json',
                    },
                    body:JSON.stringify({id:id})
                });
                if(response.status===200){
                    window.location = response.url;
                }
            }
        },
        computed:{
            Search(){
                // console.log(this.words[0].category.title);
                if(this.searchValue == ''){
                    return [...this.games];
                } else{
                    return [...this.games].filter(games=>games.title.toLowerCase().includes(this.searchValue.toLowerCase()));
                }
            }
        },
        mounted() {
            this.GetGames();
            this.GetStylesGameAll();
        },
    }
    Vue.createApp(app).mount('#AdminPage')
</script>
@endsection
