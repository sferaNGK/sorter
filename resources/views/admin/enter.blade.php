@extends('layout.app')
@section('content')
<div class="container d-flex align-items-center justify-content-center col-12" style="height: 800px;" id="AdminReg">
    <form @submit.prevent="AuthAdmin" id="reg_form" class="col-8">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Логин</label>
          <input name="login" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Пароль</label>
          <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>
<script>
    const app = {
        data(){
            return{
                errors: [],
                message: '',
            }
        },
        methods:{
            async AuthAdmin(){
                let form = document.getElementById('reg_form');
                let form_data = new FormData(form);
                const response = await fetch('{{route('login')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                    },
                    body:form_data
                });
                if(response.status===200){
                      window.location = response.url;
                }
            },
        }
    }
    Vue.createApp(app).mount('#AdminReg');
</script>
@endsection
