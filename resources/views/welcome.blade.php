@extends('layout.app')
@section('content')
<div class="container-fluid mt-5 position-relative d-flex flex-column align-items-center justify-content-center" id="game">
    <div class="container-fluid d-flex flex-column align-items-center justify-content-center">
        <div v-for="game in games" class="mt-2">
            <button @touchend="GamePage(game.id)" href="#" class="btn btn-primary" style="width: 300px; height:80px; font-size:20px;">@{{ game.title }}</button>
        </div>
    </div>
</div>
<style>
    .active{

    }
</style>
<script>
    const app1 = {
        data(){
            return{
                errors: [],
                message: '',
                games:[],
            }
        },
        methods:{
            async getGames(){
                let response_categCat = await fetch('{{ route('getGames') }}');
                this.games = await response_categCat.json();
                console.log(this.games);
            },
            async getCategory(){
                let response_categ = await fetch('{{ route('gameCategoryGet') }}');
                this.categories = await response_categ.json();
            },
            async GamePage(id){
                const response = await fetch('{{ route('show_game_page') }}',{
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
        mounted(){
            this.getCategory();
            this.getGames();
        }
    }
    Vue.createApp(app1).mount('#game');
</script>
@endsection
