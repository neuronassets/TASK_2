<!DOCTYPE html>
<html>
<head>
    <title>Registrazione alla Newsletter</title>
</head>
<body>
    <h1>Registrazione alla Newsletter</h1>
    <form method="POST" action="<?php echo e(route('newsletter.register.submit')); ?>">
        <?php echo csrf_field(); ?>
        <label>Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Registrati</button>
    </form>

    <?php if(session('status')): ?>
        <p><?php echo e(session('status')); ?></p>
    <?php endif; ?>

    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <p><?php echo e($error); ?></p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html>
<?php /**PATH /Users/fernandocolli/eclipse-workspace/my-laravel-app/resources/views/newsletter/register.blade.php ENDPATH**/ ?>