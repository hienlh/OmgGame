<?php $__env->startSection('title',__('views.admin.games.create.title') ); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php echo e(Form::open([
                'route'=>['admin.games.store'],
                'method' => 'post',
                'class'=>'form-horizontal form-label-left',
                'files' => true
                ])); ?>


            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                    <?php echo e(__('views.admin.games.create.name')); ?>

                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" type="text"
                           class="form-control col-md-7 col-xs-12 <?php if($errors->has('name')): ?> parsley-error <?php endif; ?>"
                           name="name" required>
                    <?php if($errors->has('name')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo e(__('views.admin.games.create.is_active')); ?></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="">
                        <label>
                            <input type="checkbox" class="flat" value="is_active"
                                   name="is_active"/> <?php echo e(__('views.admin.games.create.is_active')); ?>

                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="question">
                    <?php echo e(__('views.admin.games.create.question')); ?>

                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="question" type="text"
                           class="form-control col-md-7 col-xs-12"
                           name="question" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                    <?php echo e(__('views.admin.games.create.description')); ?>

                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="description" type="text"
                           class="form-control col-md-7 col-xs-12"
                           name="description">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">
                    <?php echo e(__('views.admin.games.create.image')); ?>

                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="image" type="file" name="image" accept="image/*" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary"
                       href="<?php echo e(URL::previous()); ?>"> <?php echo e(__('views.admin.games.create.cancel')); ?></a>
                    <button type="submit" class="btn btn-success"> <?php echo e(__('views.admin.games.create.submit')); ?></button>
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
    <?php echo e(Html::style(mix('assets/admin/css/users/edit.css'))); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <?php echo e(Html::script(mix('assets/admin/js/users/edit.js'))); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\Laravel\laravel-boilerplate\resources\views/admin/games/create.blade.php ENDPATH**/ ?>