<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo e(__('views.admin.games.show.delete_title', ['name' => $game->name])); ?> <a
                                href="<?php echo e(route('admin.games.index')); ?>" class="btn btn-info btn-xs"><i
                                    class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p><?php echo e(__('views.admin.games.show.confirm', ['name' => $game->name])); ?></p>

                    <form method="POST" action="<?php echo e(route('admin.games.destroy', ['id' => $game->id])); ?>">
                        <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">Yes I'm sure. Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <th><?php echo e(__('views.admin.games.show.image')); ?></th>
                <td><img src="<?php echo e($game->image); ?>" class="user-profile-image" alt="" style="width: 120px"></td>
            </tr>

            <tr>
                <th><?php echo e(__('views.admin.games.show.name')); ?></th>
                <td><?php echo e($game->name); ?></td>
            </tr>

            <tr>
                <th><?php echo e(__('views.admin.games.show.question')); ?></th>
                <td>
                    <?php echo e($game->question); ?>

                </td>
            </tr>
            <tr>
                <th><?php echo e(__('views.admin.games.show.description')); ?></th>
                <td>
                    <?php echo e($game->description); ?>

                </td>
            </tr>
            <tr>
                <th><?php echo e(__('views.admin.games.show.is_active')); ?></th>
                <td>
                    <?php if($game->is_active): ?>
                        <span class="label label-primary"><?php echo e(__('views.admin.games.show.active')); ?></span>
                    <?php else: ?>
                        <span class="label label-danger"><?php echo e(__('views.admin.games.show.inactive')); ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\Laravel\laravel-boilerplate\resources\views/admin/games/show.blade.php ENDPATH**/ ?>