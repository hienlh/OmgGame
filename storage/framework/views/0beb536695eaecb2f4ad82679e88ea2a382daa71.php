<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo e(__('views.admin.gameResults.index.title', ['name' => $game->name])); ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a href="<?php echo e(route('admin.gameResults.create', [$game->id])); ?>"><i class="fa fa-plus"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="row">
                        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-55">
                                <div class="thumbnail">
                                    <div class="image view view-first">
                                        <img style="width: 100%; display: block;" src="<?php echo e(asset($result->image)); ?>" alt="image"/>
                                        <div class="mask">
                                            <p style="color: rgba(255,255,255,0)">_</p>
                                            <div class="tools tools-bottom">
                                                <a href="<?php echo e(route('admin.gameResults.edit', [$game->id, $result->id])); ?>"><i
                                                            class="fa fa-pencil"></i></a>
                                                <a href="<?php echo e(route('admin.gameResults.destroy', [$game->id, $result->id])); ?>"><i
                                                            class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p><?php echo e($result->description); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\Laravel\laravel-boilerplate\resources\views/admin/gameResults/index.blade.php ENDPATH**/ ?>