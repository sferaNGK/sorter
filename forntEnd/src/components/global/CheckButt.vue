<template>
        <button @touchend="CheckResult" class="checkBtn w-25" style="height:80px; font-size:32px; border-radius: 7px;">Проверить</button>
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
            count:0,
        }
    },
    methods:{
        CheckResult(){
            if(this.list1.length != 0){
                this.list1.forEach(element => {
                     if(this.categories[0].includes(element)){
                         document.getElementById(`element_${element.id}`).classList.add('right-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('wrong-btn');
                     } else{
                         document.getElementById(`element_${element.id}`).classList.add('wrong-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('right-btn');
                     }
                });
            }
            if(this.list2.length != 0){
                this.list2.forEach(element => {
                     if(this.categories[1].includes(element)){
                         document.getElementById(`element_${element.id}`).classList.add('right-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('wrong-btn');

                     } else{
                         document.getElementById(`element_${element.id}`).classList.add('wrong-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('right-btn');

                     }
                });
            }
            if(this.list3.length != 0){
                this.list3.forEach(element => {
                     if(this.categories[2].includes(element)){
                         document.getElementById(`element_${element.id}`).classList.add('right-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('wrong-btn');

                     } else{
                         document.getElementById(`element_${element.id}`).classList.add('wrong-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('right-btn');

                     }
                });
            }
            if(this.list4.length !=0){
                this.list4.forEach(element => {
                     if(this.categories[3].includes(element)){
                         document.getElementById(`element_${element.id}`).classList.add('right-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('wrong-btn');

                     } else{
                         document.getElementById(`element_${element.id}`).classList.add('wrong-btn');
                         document.getElementById(`element_${element.id}`).classList.remove('right-btn');

                     }
                });
            }
            this.count = document.querySelectorAll('.right-btn').length;
            this.$emit("changeValue", this.count);
    }
}
}
</script>
