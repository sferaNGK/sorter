<template>
    <div class="modal-container">
        <div class="modal-backdrop show"></div>
        <div class="modal show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center justify-content-center">
                        <h5 class="modal-title modalText" style="font-size: 25px; font-weight:800;" v-if="length == count && children == false">
                            Победа!
                        </h5>
                        <h5 class="modal-title modalText" style="font-size: 25px; font-weight:800;" v-else-if="children == false && count != 0">
                            Поздравляем!
                        </h5>
                        <h5 class="modal-title modalText" style="font-size: 25px; font-weight:800;" v-else-if="children == false">
                            Сожалеем!
                        </h5>
                        <h5 class="modal-title modalText" style="font-size: 25px; font-weight:800;" v-else>
                            Поздравляем!
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p class="modalText" v-if="length == count && children === false || children == true">
                          Вы распределили всё правильно!
                        </p>
                        <p class="modalText" v-else-if="children === true">
                          Вы верно распределили {{ count }} из {{length}} элемента(ов)
                        </p>
                        <p class="modalText" v-else>
                          Вы верно распределили {{ count }} из {{length}} элемента(ов)
                        </p>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <router-link to="/" class="w-100 text-center">
                            <button class="btn btnModal" style="font-size:20px; width: 75% !important;">Вернуться на главную</button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
      </div>
</template>
<script>
import { RouterLink, RouterView } from 'vue-router';
export default {
    props:{
        modal:{
            type:Boolean,
        },
        count:{
            type:Number
        },
        length:{
            type:Number
        },
        children:{
            type:Boolean
        }
    }
}
</script>
