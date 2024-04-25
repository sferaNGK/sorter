<?php $__env->startSection('content'); ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">AdminPanel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo e(route('welcome')); ?>">Главная</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('show_categories_page')); ?>">Категории</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('show_words_page')); ?>">Слова</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('show_games_page')); ?>">Игры</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('show_styles_page')); ?>">Стили</a>
          </li>
          <?php if(auth()->guard()->check()): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('AdminLog')); ?>">выйти</a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <?php echo $__env->yieldContent('contented'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\onixc\Downloads\sorter\resources\views/admin/index.blade.php ENDPATH**/ ?>