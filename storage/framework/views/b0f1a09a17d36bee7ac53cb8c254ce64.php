<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-5 position-relative d-flex flex-column align-items-center justify-content-center" id="game">
    <div class="container-fluid d-flex flex-column align-items-center justify-content-center">
        <div v-for="game in games" class="mt-2">
            <button @touchend="GamePage(game.id)" href="#" class="btn btn-primary" style="width: 300px; height:80px; font-size:20px;">{{ game.title }}</button>
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
                let response_categCat = await fetch('<?php echo e(route('getGames')); ?>');
                this.games = await response_categCat.json();
                console.log(this.games);
            },
            async getCategory(){
                let response_categ = await fetch('<?php echo e(route('gameCategoryGet')); ?>');
                this.categories = await response_categ.json();
            },
            async GamePage(id){
                const response = await fetch('<?php echo e(route('show_game_page')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vue\sorter\resources\views/welcome.blade.php ENDPATH**/ ?>