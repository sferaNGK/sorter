<template>

        <button @click="CheckResult" class="btn btn-primary w-25">Проверить</button>

</template>
<script>
export default {
    props:{
        list1:{
            type:Array
        },
        list2:{
            type:Array
        },
        list3:{
            type:Array
        },
        list4:{
            type:Array
        },
        categories:{
            type:Array
        },
    },
    data(){
        return{
            modal:false,
        }
    },
    methods:{
        CheckResult(){
            if(this.list1.length != 0){
                for(let i = 0; i < this.list1.length; i++){
                let word = document.getElementById(`element_${this.list1[i].id}`);
                if((this.categories[0].includes(this.list1[i]) && this.list1[i].title == word.textContent) || (this.categories[0].includes(this.list1[i]) && 'http://127.0.0.1:8000' + this.list1[i].img === word.firstChild.src)){word.classList.add('right');}
                }
            }
            if(this.list2.length != 0){
            for(let i = 0; i < this.list2.length; i++){
                let word = document.getElementById(`element_${this.list2[i].id}`);
                if((this.categories[1].includes(this.list2[i]) && this.list2[i].title == word.textContent) || (this.categories[1].includes(this.list2[i]) && 'http://127.0.0.1:8000' + this.list2[i].img === word.firstChild.src)){ word.classList.add('right');}
                }
            }
            if(this.list3.length != 0){
            for(let i = 0; i < this.list3.length; i++){
                let word = document.getElementById(`element_${this.list3[i].id}`);
                if((this.categories[2].includes(this.list3[i]) && this.list3[i].title == word.textContent) || (this.categories[2].includes(this.list3[i]) && 'http://127.0.0.1:8000' + this.list3[i].img === word.firstChild.src)){word.classList.add('right');}
                }
            }
            if(this.list4.length !=0){
            for(let i = 0; i < this.list3.length; i++){
                let word = document.getElementById(`element_${this.list4[i].id}`);
                if((this.categories[3].includes(this.list4[i]) && this.list4[i].title == word.textContent) || (this.categories[3].includes(this.list4[i]) && 'http://127.0.0.1:8000' + this.list4[i].img === word.firstChild.src)){word.classList.add('right');}
                }
            }
        },
    }
}
</script>
