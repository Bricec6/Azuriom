<?php $__env->startSection('title', trans('admin.plugins.title')); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0"><?php echo e(trans('admin.plugins.list')); ?></h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"><?php echo e(trans('messages.fields.name')); ?></th>
                        <th scope="col"><?php echo e(trans('messages.fields.author')); ?></th>
                        <th scope="col"><?php echo e(trans('messages.fields.version')); ?></th>
                        <th scope="col"><?php echo e(trans('messages.fields.enabled')); ?></th>
                        <th scope="col"><?php echo e(trans('messages.fields.action')); ?></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $__currentLoopData = $plugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $path => $plugin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row">
                                <?php if(isset($plugin->url)): ?>
                                    <a href="<?php echo e($plugin->url); ?>" target="_blank" rel="noopener noreferrer">
                                        <?php echo e($plugin->name); ?>

                                    </a>
                                <?php else: ?>
                                    <?php echo e($plugin->name); ?>

                                <?php endif; ?>
                            </th>
                            <td><?php echo e(implode(', ', $plugin->authors ?? [])); ?></td>
                            <td><?php echo e($plugin->version); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e(plugins()->isEnabled($path) ? 'success' : 'danger'); ?>">
                                    <?php echo e(trans_bool(plugins()->isEnabled($path))); ?>

                                </span>
                            </td>
                            <td>
                                <form method="POST" action="<?php echo e(route('admin.plugins.' . (plugins()->isEnabled($path) ? 'disable' : 'enable'), $path)); ?>" class="d-inline-block">
                                    <?php echo csrf_field(); ?>

                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="bi bi-<?php echo e(plugins()->isEnabled($path)  ? 'x-lg' : 'check-lg'); ?>"></i> <?php echo e(trans('messages.actions.'.(plugins()->isEnabled($path) ? 'disable' : 'enable'))); ?>

                                    </button>
                                </form>
                                <?php if(! plugins()->isEnabled($path)): ?>
                                    <a href="<?php echo e(route('admin.plugins.delete', $path)); ?>" class="btn btn-danger btn-sm" data-confirm="delete">
                                        <i class="bi bi-trash"></i> <?php echo e(trans('messages.actions.delete')); ?>

                                    </a>
                                <?php endif; ?>
                                <?php if($pluginsUpdates->has($path)): ?>
                                    <form method="POST" action="<?php echo e(route('admin.plugins.update', $path)); ?>" class="d-inline-block">
                                        <?php echo csrf_field(); ?>

                                        <button type="submit" class="btn btn-info btn-sm">
                                            <i class="bi bi-download"></i> <?php echo e(trans('messages.actions.update')); ?>

                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0"><?php echo e(trans('admin.plugins.available')); ?></h5>
        </div>
        <div class="card-body">
            <?php if(! $availablePlugins->isEmpty()): ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> <?php echo app('translator')->get('admin.extensions.market', ['url' => 'https://market.azuriom.com/resources?type=plugin']); ?>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col"><?php echo e(trans('messages.fields.name')); ?></th>
                            <th scope="col"><?php echo e(trans('messages.fields.description')); ?></th>
                            <th scope="col"><?php echo e(trans('messages.fields.author')); ?></th>
                            <th scope="col"><?php echo e(trans('messages.fields.version')); ?></th>
                            <th scope="col"><?php echo e(trans('messages.fields.action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $availablePlugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plugin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row">
                                    <a href="<?php echo e($plugin['info_url']); ?>" target="_blank" rel="noopener noreferrer" class="me-2">
                                        <?php echo e($plugin['name']); ?>

                                    </a>

                                    <span class="badge bg-secondary">
                                        <i class="bi bi-download"></i> <?php echo e($plugin['downloads']); ?>

                                    </span>

                                    <span class="badge bg-secondary">
                                        <i class="bi bi-heart"></i> <?php echo e($plugin['likes']); ?>

                                    </span>
                                </th>
                                <td><?php echo e($plugin['short_description']); ?></td>
                                <td><?php echo e($plugin['author']['name']); ?></td>
                                <td><?php echo e($plugin['version']); ?></td>
                                <td>
                                    <?php if($plugin['premium'] && ! $plugin['purchased']): ?>
                                        <a href="<?php echo e($plugin['info_url']); ?>" class="btn btn-info btn-sm" target="_blank" rel="noopener noreferrer">
                                            <i class="bi bi-card"></i> <?php echo e(trans('admin.extensions.buy', ['price' =>  $plugin['price']])); ?>

                                        </a>
                                    <?php else: ?>
                                        <form method="POST" action="<?php echo e(route('admin.plugins.download', $plugin['id'])); ?>">
                                            <?php echo csrf_field(); ?>

                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="bi bi-download"></i> <?php echo e(trans('messages.actions.download')); ?>

                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('admin.plugins.reload')); ?>">
                <?php echo csrf_field(); ?>

                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-arrow-repeat"></i> <?php echo e(trans('messages.actions.reload')); ?>

                </button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Logiciel\laragon\www\Azuriomm\resources\views/admin/plugins/index.blade.php ENDPATH**/ ?>