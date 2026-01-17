<?php if(Auth::user()->image): ?>
    <div class="container-avatar">
        <img src="<?php echo e(route('user.avatar', ['filename'=>Auth::user()->image])); ?>" alt="" class="avatar">
    </div>
<?php endif; ?><?php /**PATH /workspaces/codespaces-blank/resources/views/includes/avatar.blade.php ENDPATH**/ ?>