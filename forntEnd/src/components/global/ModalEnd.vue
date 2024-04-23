<template>
    <div class="modal-container">
        <div class="modal-backdrop show"></div>
        <div class="modal show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center justify-content-center">
                        <h5 class="modal-title" v-if="length == count && children == false">
                            Победа!
                        </h5>
                        <h5 class="modal-title" v-else-if="children == false && count != 0">
                            Поздравляем!
                        </h5>
                        <h5 class="modal-title" v-else-if="children == false">
                            Сожалеем!
                        </h5>
                        <h5 class="modal-title" v-else>
                            Поздравляем!
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p v-if="length == count && children === false || children == true">
                          Поздравляем, вы распределили всё правильно!
                        </p>
                        <p v-else-if="children === true">
                          Вы верно распределили {{ count }} элемента(ов)
                        </p>
                        <p v-else>
                          Вы верно распределили {{ count }} элемента(ов)
                        </p>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <router-link to="/" class="w-100 text-center">
                            <button class="btn btn-primary w-50 h-50">Вернутся на главную</button>
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
