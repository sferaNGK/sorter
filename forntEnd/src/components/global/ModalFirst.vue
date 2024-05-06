<template>
    <div class="modal-container">
        <div class="modal-backdrop show"></div>
        <div class="modal show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modalCategory text-center mb-5 d-flex align-items-center justify-content-center rounded" style="height:80px;">
                    <h5 class="modalCategoryTitlte" style="font-size:25px; color:white;">{{ titleCat }}</h5>
                </div>
                <div class="modal-content">
                    <div class="modal-body">
                        <h5 class="modal-title modalText text-center mb-4 fs-4" style="font-weight: 900; font-size: 26px !important;">
                            Инструкция игры
                        </h5>
                        <p class="modalText">
                            {{ description }}
                        </p>
                        <ul>
                            <li class="modalText">Переносите слово/изображение в подходящую категорию</li>
                            <li class="modalText">Проверяйте свой ответ</li>
                            <li class="modalText">Переносите слово/изображение из одной категории в другую (если ответ неверен)</li>
                            <li class="modalText">Продолжайте до тех пор, пока не распределите все слова/изображения верно</li>
                        </ul>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btnModal btn w-50 h-50" @click="CloseModal">Продолжить</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
</template>
<script>
export default {
    props:{
        description:{
            type:String
        },
        titleCat:{
            type:String
        }
    },
    methods:{
        CloseModal(){
            const diag = document.querySelector(".modal-container");
            diag.classList.add("d-none");
        }
    }
}
</script>
