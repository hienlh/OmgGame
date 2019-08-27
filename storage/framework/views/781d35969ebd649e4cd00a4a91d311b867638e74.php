<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo e(__('views.admin.gameResults.show.delete_title')); ?> <a
                                href="<?php echo e(route('admin.gameResults.index', [$game->id])); ?>" class="btn btn-info btn-xs"><i
                                    class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p><?php echo e(__('views.admin.gameResults.show.confirm')); ?></p>

                    <form method="POST" action="<?php echo e(route('admin.gameResults.destroy', [$game->id, $result->id])); ?>">
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
                <th><?php echo e(__('views.admin.gameResults.show.image')); ?></th>
                <td><img src="<?php echo e(asset($result->image)); ?>" class="user-profile-image" alt="" style="width: 120px"></td>
            </tr>

            <tr>
                <th><?php echo e(__('views.admin.gameResults.show.description')); ?></th>
                <td><?php echo e($result->description); ?></td>
            </tr>

            <tr>
                <th><?php echo e(__('views.admin.gameResults.show.design')); ?></th>
                <td><?php echo e($result->design); ?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\Laravel\laravel-boilerplate\resources\views/admin/gameResults/show.blade.php ENDPATH**/ ?>