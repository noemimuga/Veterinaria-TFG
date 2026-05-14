<?php $__env->startSection('title', 'Listado de Animales - Refugio Nubeko'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="text-center">Animales en adopción</h1>
    <div class="mb-4 text-center">

</div>

    
    <div class="card mb-4">
        <div class="card-body">
            <form action="<?php echo e(route('adopta.index')); ?>" method="GET">

                <div class="row g-3">
                    
                    <div class="col-md-3">
                        <label for="buscar" class="form-label">Buscar</label>
                        <input
                            type="text"
                            class="form-control"
                            id="buscar"
                            name="buscar"
                            placeholder="Nombre o raza"
                            value="<?php echo e(request('buscar')); ?>">
                    </div>

                    
                    <div class="col-md-2">
                        <label for="especie" class="form-label">Especie</label>
                        <select class="form-select" id="especie" name="especie">
                            <option value="">Todas</option>
                            <option value="perro" <?php echo e(request('especie') == 'perro' ? 'selected' : ''); ?>>Perro</option>
                            <option value="gato" <?php echo e(request('especie') == 'gato' ? 'selected' : ''); ?>>Gato</option>
                        </select>
                    </div>

                    
                    <div class="col-md-2">
                        <label for="raza" class="form-label">Raza</label>
                        <input
                            type="text"
                            class="form-control"
                            id="raza"
                            name="raza"
                            placeholder="Raza"
                            value="<?php echo e(request('raza')); ?>">
                    </div>

                    
                    <div class="col-md-2">
                        <label for="edad" class="form-label">Edad</label>
                        <select class="form-select" id="edad" name="edad">
                            <option value="">Todas</option>
                            <option value="cachorro" <?php echo e(request('edad') == 'cachorro' ? 'selected' : ''); ?>>Cachorro (0-1 año)</option>
                            <option value="joven" <?php echo e(request('edad') == 'joven' ? 'selected' : ''); ?>>Joven (1-3 años)</option>
                            <option value="adulto" <?php echo e(request('edad') == 'adulto' ? 'selected' : ''); ?>>Adulto (3-7 años)</option>
                            <option value="senior" <?php echo e(request('edad') == 'senior' ? 'selected' : ''); ?>>Senior (7+ años)</option>
                        </select>
                    </div>

                    
                    <div class="col-md-2">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select" id="sexo" name="sexo">
                            <option value="">Todas</option>               
                            <option value="Hembra" <?php echo e(request('sexo') == 'Hembra' ? 'selected' : ''); ?>>Hembra</option>
                            <option value="Macho" <?php echo e(request('sexo') == 'Macho' ? 'selected' : ''); ?>>Macho</option>
                        </select>
                    </div>

                    
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    </div>
                </div>

                
                <?php if(request()->anyFilled(['buscar', 'especie', 'raza', 'edad', 'sexo'])): ?>
                <div class="row mt-2">
                    <div class="col-12">
                        <a href="<?php echo e(route('adopta.index')); ?>" class="btn btn-secondary btn-sm">Limpiar filtros</a>
                    </div>
                </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="grid">
        <?php $__empty_1 = true; $__currentLoopData = $animales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card">
            <!-- Imagen del animal -->
            <img src="<?php echo e(asset('img/' . $animal->foto)); ?>" alt="<?php echo e($animal->nombre); ?>">

            <div class="card-body">
                <h3><?php echo e($animal->nombre); ?></h3>
                <p><strong>Raza:</strong> <?php echo e($animal->raza); ?></p>
                <p><strong>Edad:</strong> <?php echo e($animal->edad); ?> años</p>
                <p><strong>Sexo:</strong> <?php echo e($animal->sexo); ?> años</p>

                <a href="<?php echo e(route('animales.show', $animal->id)); ?>" class="btn">Conocer a <?php echo e($animal->nombre); ?></a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="no-results">
            <p>Actualmente no hay animales disponibles para adopción.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        padding: 2rem 0;
    }

    .card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 20px var(--shadow);
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .card-body {
        padding: 1.5rem;
    }

    .btn {
        display: block;
        text-align: center;
        background: var(--accent);
        color: white;
        padding: 0.8rem;
        border-radius: 10px;
        text-decoration: none;
        margin-top: 1rem;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Veterinaria-TFG\resources\views/adopta/index.blade.php ENDPATH**/ ?>