@extends('layout.app')
@section('content')
<div class="container mt-5 position-relative d-flex flex-column" id="game">
    <div class="container d-flex flex-column" style="height: 50px;">
        <div class="d-flex flex-row gap-2">
            <div class="container position-relative border rounded target" v-for="title in titles">
                <p>@{{ title.title }}</p>
                <hr>
            </div>
        </div>
    </div>
    <div class="container d-flex flex-column mt-5" id="place">
        <div class="d-flex flex-row gap-2">
            <div class="container border rounded target" style="height: 300px" v-for="title in titles" :id="`title_${title.id}`">

            </div>
        </div>
    </div>
    <div class="container flex-wrap d-flex flex-row col-12 mt-5 wordes">
        <div class="container-fluid d-flex flex-row" style="height: 50px; width:150px;" v-for="word in words">
            <div class="border position-absolute rounded d-flex align-items-center justify-content-center word" style="height: 50px; width:150px;"  draggable="true">
                <p>@{{ word.title }}</p>
            </div>
        </div>
    </div>
    <button class="btn btn-primary mt-5" style="width: 200px" @touchend="Check">Проверить</button>
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
                categories:[],
                message: '',
                words:[],
                titles:[],
                answ:[],

                right:[],
                wrong:[],
            }
        },
        methods:{
            async getCategory(){
                let response_categ = await fetch('{{ route('gameCategoryGet') }}');
                this.categories = await response_categ.json();
                this.categories.forEach(element => {
                    element.forEach(elem => {
                        this.words.push(elem);
                    });
                });
                this.categories.forEach(element => {
                    this.titles.push(element[0].category)
                });
            },
            async InitGame(){
                let words = document.querySelectorAll('.word');
                let container = document.getElementById('place');
                let target = document.querySelectorAll('.target');
                let elementAppend;

                words.forEach(elem =>{
                    elem.addEventListener('touchmove', function(event){
                        event.preventDefault();
                        let touch = event.targetTouches[0];
                        elem.style.top = `${touch.pageY - container.offsetTop - (elem.offsetHeight / 2)}px`;
                        elem.style.left = `${touch.pageX - container.offsetLeft - (elem.offsetWidth / 2)}px`;

                        target.forEach(element => {
                            if(
                                elem.getBoundingClientRect().top + (elem.offsetHeight / 2)< element.getBoundingClientRect().bottom &&
                                elem.getBoundingClientRect().right - (elem.offsetWidth / 2) > element.getBoundingClientRect().left &&
                                elem.getBoundingClientRect().bottom - (elem.offsetHeight / 2) > element.getBoundingClientRect().top &&
                                elem.getBoundingClientRect().left + (elem.offsetWidth / 2) < element.getBoundingClientRect().right
                            ){
                                element.classList.add('active');
                                elementAppend = element;
                            } else{

                            }
                        });
                    });
                    elem.addEventListener('touchend', function(event){
                        if(elementAppend.classList.contains('active')){
                            elementAppend.append(this);
                            this.style.top = `${elementAppend.offsetTop}`;
                            this.style.left = `${elementAppend.offsetLeft}`;
                            this.style.marginBottom = '5px';
                        } else{
                            this.style.top = `${elementAppend.offsetTop}`;
                            this.style.left = `${elementAppend.offsetLeft}`;
                        }
                    });
                });
            },
            async Check(){

                let arr1=[];
                let arr2=[];
                let res = [];
                let res1 = [];
                let title1;
                let title2;

                this.titles.forEach(element => {
                    title1 = document.getElementById(`title_${this.titles[0].id}`).childNodes;
                    title2 = document.getElementById(`title_${this.titles[1].id}`).childNodes;
                });

               title1.forEach(element => {
                    arr1.push(element.childNodes);
                });

               title2.forEach(element => {
                    arr2.push(element.childNodes);
                });

                arr1.forEach(element => {
                    res.push(element[0].innerHTML);
                });
                arr2.forEach(element => {
                    res1.push(element[0].innerHTML);
                });

                let id = `${this.titles[0].id}`;
                let id1 = `${this.titles[1].id}`;

                let form_data = new FormData();
                form_data.append('title1',res);
                form_data.append('title2',res1);
                form_data.append('id',id);
                form_data.append('id2',id1);
                const response = await fetch('{{route('checkGame')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                    },
                    body:form_data
                });
                if(response.status == 200){
                    this.answ = await response.json();
                    this.right = this.answ[0];
                    this.wrong = this.answ[1];
                    arr1.forEach(element => {
                        this.right.forEach(elem => {
                            if(element[0].innerHTML == elem){
                                element[0].parentNode.style.background = 'green';
                                element[0].style.color = 'white';
                            }
                        });
                        this.wrong.forEach(elem => {
                            if(element[0].innerHTML == elem){
                                element[0].parentNode.style.background = 'red';
                                element[0].style.color = 'white';
                            }
                        });
                    });
                    arr2.forEach(element => {
                        this.right.forEach(elem => {
                            if(element[0].innerHTML == elem){
                                element[0].parentNode.style.background = 'green';
                                element[0].style.color = 'white';
                            }
                        });
                        this.wrong.forEach(elem => {
                            if(element[0].innerHTML == elem){
                                element[0].parentNode.style.background = 'red';
                                element[0].style.color = 'white';
                            }
                        });
                    });
                }
            }
        },
        mounted(){
            this.getCategory();
            setInterval(() => {
                this.InitGame();
            }, 550);
        }
    }
    Vue.createApp(app1).mount('#game');
</script>
@endsection
