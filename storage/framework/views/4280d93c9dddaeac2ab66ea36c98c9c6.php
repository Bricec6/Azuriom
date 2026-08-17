<?php $__env->startPush('scripts'); ?><?php if ($__env->exists('custom.head')) echo $__env->make('custom.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php $__env->stopPush(); ?>

<?php $__env->startPush('footer-scripts'); ?><?php if ($__env->exists('custom.body')) echo $__env->make('custom.body', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php $__env->stopPush(); ?>

<?php if($keywords = setting('keywords')): ?> <?php $__env->startPush('meta'); ?>
    <meta name="keywords" content="<?php echo e($keywords); ?>">
<?php $__env->stopPush(); ?> <?php endif; ?>

<?php if(($welcomeAlert = setting('welcome_alert')) && ! session()->has('welcome_alert')): ?>
    <?php $__env->startPush('footer-scripts'); ?>
        <!-- Modal -->
        <div class="modal fade" id="welcomeAlertModal" tabindex="-1" role="dialog" aria-labelledby="welcomeAlertLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="welcomeAlertLabel"><?php echo e(site_name()); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo $welcomeAlert; ?>

                    </div>
                </div>
            </div>
        </div>

        <script>
            window.addEventListener('load', function () {
                setTimeout(function () {
                    new bootstrap.Modal(document.getElementById('welcomeAlertModal')).show();
                }, 500);
            });
        </script>
    <?php $__env->stopPush(); ?>

    <?php (session()->put('welcome_alert', true)); ?>
<?php endif; ?>
<?php /**PATH F:\Logiciel\laragon\www\Azuriomm\resources\views/elements/base.blade.php ENDPATH**/ ?>