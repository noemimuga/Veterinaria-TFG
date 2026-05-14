<?php $__env->startSection('title', 'Mis favoritos'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-favoritos">

    <h1 class="titulo">Mis favoritos</h1>

    <?php if($favoritos->count() == 0): ?>
        <div class="empty">
            <p>No tienes animales en favoritos todavía.</p>
            <a href="<?php echo e(route('adopta.index')); ?>" class="btn">
                Ver animales
            </a>
        </div>
    <?php endif; ?>

    <div class="grid">

        <?php $__currentLoopData = $favoritos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="card">

                <?php if($fav->animal->foto): ?>
                    <img src="<?php echo e(asset('storage/' . $fav->animal->foto)); ?>" alt="<?php echo e($fav->animal->nombre); ?>">
                <?php else: ?>
                    <div style="height:250px; display:flex; align-items:center; justify-content:center; background:#f5f1ea;">
                        🐾
                    </div>
                <?php endif; ?>

                <div class="card-content">

                    <h3><?php echo e($fav->animal->nombre); ?></h3>

                    <p><strong>Especie:</strong> <?php echo e($fav->animal->especie); ?></p>
                    <p><strong>Edad:</strong> <?php echo e($fav->animal->edad); ?></p>

                    <div style="display:flex; flex-direction:column; gap:10px; margin-top:15px;">

                        <a href="<?php echo e(route('animales.show', $fav->animal->id)); ?>" class="btn">
                            Ver detalle
                        </a>

                        <form action="<?php echo e(route('favoritos.destroy', $fav->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button type="submit" class="btn-danger">
                             Quitar de favoritos
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('extra-styles'); ?>

<style>

.container-favoritos{
    max-width: 1200px;
    margin: auto;
    padding: 40px 20px;
}

.titulo{
    text-align:center;
    margin-bottom:40px;
    color:#8b7355;
    font-size:2.5rem;
}

/* GRID */
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
    gap:25px;
}

/* CARD */
.card{
    background:white;
    border-radius:16px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card img{
    width:100%;
    height:250px;
    object-fit:cover;
}

.card-content{
    padding:1.5rem;
}

.card-content h3{
    color:#8b7355;
    margin-bottom:10px;
}

.card-content p{
    color:#666;
    margin:5px 0;
}

/* BOTÓN VER */
.btn{
    display:inline-block;
    text-align:center;
    padding:10px;
    background:#d4a574;
    color:white;
    border-radius:8px;
    text-decoration:none;
    transition:0.3s;
}

.btn:hover{
    background:#b8865a;
}

/* BOTÓN ELIMINAR */
.btn-danger{
    width:100%;
    padding:10px;
    background:#c0392b;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
    transition:0.3s;
}

.btn-danger:hover{
    background:#a93226;
}

/* VACÍO */
.empty{
    text-align:center;
    padding:3rem;
    background:white;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

.empty p{
    margin-bottom:15px;
    color:#8b7355;
}

</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Veterinaria-TFG\resources\views/favoritos/index.blade.php ENDPATH**/ ?>