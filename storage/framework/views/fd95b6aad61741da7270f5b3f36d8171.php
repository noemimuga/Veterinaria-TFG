<?php $__env->startSection('title', 'Mi Cuenta'); ?>

<?php $__env->startSection('content'); ?>

<div class="profile-container">

    <h1 class="title">Mi Cuenta</h1>

    <div class="profile-grid">

        
        <div class="profile-card">

            <h2>Información personal</h2>

            <p><strong>Nombre:</strong> <?php echo e(Auth::user()->name); ?></p>
            <p><strong>Email:</strong> <?php echo e(Auth::user()->email); ?></p>

            <p><strong>Rol:</strong> <?php echo e(Auth::user()->tipo ?? 'Usuario'); ?></p>

        </div>

        
        <?php if(Auth::user()->tipo !== 'refugio'): ?>
        <div class="profile-card">
            <h2>Favoritos</h2>
            <p>Aquí verás tus animales guardados.</p>
            <a href="<?php echo e(route('favoritos.index')); ?>" class="btn">
                Ver favoritos
            </a>
        </div>
        <?php endif; ?>

        
        <?php if(Auth::user()->tipo === 'refugio'): ?>
        <div class="profile-card highlight">
            <h2>Panel Refugio</h2>
            <p>Gestiona animales y solicitudes.</p>
            <a href="<?php echo e(route('refugio.dashboard')); ?>" class="btn">
                Ir al panel
            </a>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-styles'); ?>

<style>
    .profile-container {
        max-width: 1100px;
        margin: auto;
        padding: 40px 20px;
    }

    .title {
        text-align: center;
        margin-bottom: 40px;
        color: #8b7355;
        font-size: 2.5rem;
        font-family: 'Cormorant', serif;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .profile-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: 0.3s;
    }

    .profile-card:hover {
        transform: translateY(-3px);
    }

    .profile-card h2 {
        margin-bottom: 15px;
        color: #8b7355;
    }

    .profile-card p {
        margin: 8px 0;
        color: #555;
    }

    .btn {
        display: block;
        text-align: center;
        padding: 10px;
        margin-top: 15px;
        background: #d4a574;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn:hover {
        background: #b8865a;
    }

    .btn-danger {
        background: #c0392b;
    }

    .btn-danger:hover {
        background: #a93226;
    }

    .highlight {
        border: 2px solid #d4a574;
    }
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Veterinaria-TFG\resources\views/profile/custom.blade.php ENDPATH**/ ?>