<?php $__env->startSection('content'); ?>
    <div class="title m-b-md">
        <?php echo e(config('app.name')); ?>

    </div>
    <div class="m-b-md">
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\Laravel\laravel-boilerplate\resources\views/welcome.blade.php ENDPATH**/ ?>