<template>
    <div class="modal-container">
        <div class="modal-backdrop show"></div>
        <div class="modal show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center justify-content-center">
                        <h5 class="modal-title">
                            Правила игры
                        </h5>
                        <!-- <button class="btn-close" @click="CloseModal"></button> -->
                    </div>
                    <div class="modal-body">
                        <p>
                            Добро пожаловать в игру "Название игры".
                            Здесь вам предстоит распределить набор слов или картинок
                            по заданным категориям.
                        </p>
                        <ul>
                            <li>Переносите слово/изображение в подходящую категорию</li>
                            <li>Проверяйте свой ответ</li>
                            <li>Переносите слово/изображение из одной категории в другую (если ответ неверен)</li>
                            <li>Продолжайте до тех пор, пока не распределите все слова/изображения верно</li>
                        </ul>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-primary w-50 h-50" @click="CloseModal">Продолжить</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
</template>
<script>
export default {
    methods:{
        CloseModal(){
            const diag = document.querySelector(".modal-container");
            diag.classList.add("d-none");
        }
    }
}
</script>
