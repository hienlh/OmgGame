<?php $__env->startSection('body_class','passwords_reset'); ?>

<?php $__env->startSection('content'); ?>
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <?php echo e(Form::open(['route' => 'password.request'])); ?>

                    <h1><?php echo e(__('views.auth.passwords.reset.header')); ?></h1>

                    <input type="hidden" name="token" value="<?php echo e($token); ?>">

                    <div>
                        <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>"
                               placeholder="<?php echo e(__('views.auth.passwords.reset.input_0')); ?>" required autofocus>
                    </div>
                    <div>
                        <input id="password" type="password" class="form-control" name="password"
                               placeholder="<?php echo e(__('views.auth.passwords.reset.input_1')); ?>" required>
                    </div>

                    <div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               placeholder="<?php echo e(__('views.auth.passwords.reset.input_2')); ?>" required>
                    </div>

                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(!$errors->isEmpty()): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $errors->first(); ?>

                        </div>
                    <?php endif; ?>

                    <div>
                        <button class="btn btn-default submit" type="submit"><?php echo e(__('views.auth.passwords.reset.action')); ?></button>
                        <a class="reset_pass" href="<?php echo e(route('login')); ?>">
                            <?php echo e(__('views.auth.passwords.reset.message')); ?>

                        </a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <div>
                            <div class="h1"><?php echo e(config('app.name')); ?></div>
                            <p>&copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. <?php echo e(__('views.auth.passwords.reset.copyright')); ?></p>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </section>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##

    <?php echo e(Html::style(mix('assets/auth/css/passwords.css'))); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\Laravel\laravel-boilerplate\resources\views/auth/passwords/reset.blade.php ENDPATH**/ ?>