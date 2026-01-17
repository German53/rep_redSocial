<!DOCTYPE html>


<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card pub_image">
                <div style="float: left;">
                    <div class="comments mt-3">
                        <h4>Inicia sesión para ver el contenido de la pagina, <a href="<?php echo e(route('login')); ?>">aqui!</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/codespaces-blank/resources/views/welcome.blade.php ENDPATH**/ ?>