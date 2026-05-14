<?php $__env->startSection('title', 'Refugio Nubeko'); ?>

<?php $__env->startSection('content'); ?>
<div class="home-container">
    <!-- SECCIÓN HERO-->
    <section class="hero">
        <div class="hero-content">
            <h1>Bienvenid@ a nuestro refugio</h1>
            <p>En Nubeko, transformamos el destino de animales rescatados dándoles una segunda oportunidad.
            Al adoptar, no solo cambias su mundo, ellos también cambiarán el tuyo. </p>

            <div class="hero-actions">
                <a href="<?php echo e(route('adopta.index')); ?>" class="btn-hero-primary">Quiero adoptar</a>
                <a href="<?php echo e(route('contacto.index')); ?>" class="btn-hero-secondary">Saber más</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="https://i.pinimg.com/1200x/6a/c6/ee/6ac6ee7c7c21810df64e3dfed7dedfb3.jpg" alt="Perro  y gato">
        </div>
    </section>

    <section class="quick-categories">
        <h2>¿A quién buscas?</h2>
        <div class="categories-grid">
            <a href="<?php echo e(route('adopta.index', ['especie' => 'perro'])); ?>" class="category-card">
                <span class="icon">🐶</span>
                <h3>Perros</h3>
            </a>
            <a href="<?php echo e(route('adopta.index', ['especie' => 'gato'])); ?>" class="category-card">
                <span class="icon">🐱</span>
                <h3>Gatos</h3>
            </a>

        </div>
    </section>
</div>

<style>
    .home-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 4rem;
        padding: 4rem 0;
    }

    .hero-content {
        flex: 1;
    }

    .hero-content h1 {
        font-family: 'Cormorant', serif;
        font-size: 3.5rem;
        line-height: 1.1;
        color: var(--beige-800);
        margin-bottom: 1.5rem;
    }

    .hero-content p {
        font-size: 1.2rem;
        color: var(--beige-600);
        margin-bottom: 2rem;
    }

    .hero-image {
        flex: 1;
    }

    .hero-image img {
        width: 100%;
        border-radius: 30px;
        box-shadow: 20px 20px 0px var(--beige-200);
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
    }

    .btn-hero-primary {
        background: var(--accent);
        color: white;
        padding: 1rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-hero-secondary {
        border: 2px solid var(--accent);
        color: var(--accent);
        padding: 1rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-hero-primary:hover { background: var(--accent-dark); transform: translateY(-3px); }

    /* Categorías */
    .quick-categories {
        text-align: center;
        padding: 5rem 0;
    }

    .quick-categories h2 {
        font-family: 'Cormorant', serif;
        font-size: 2.5rem;
        margin-bottom: 3rem;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(200px, 350px));
        justify-content: center;
        gap: 2rem;
    }

    .category-card {
        background: white;
        padding: 3rem;
        border-radius: 20px;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 10px 30px var(--shadow);
        transition: 0.3s;
        border: 1px solid var(--beige-100);
    }

    .category-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent);
    }

    .category-card .icon { font-size: 3rem; display: block; margin-bottom: 1rem; }

    @media (max-width: 768px) {
        .hero { flex-direction: column; text-align: center; }
        .hero-content h1 { font-size: 2.5rem; }
        .hero-actions { justify-content: center; }
        .categories-grid { grid-template-columns: 1fr; }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Veterinaria-TFG\resources\views/animales/index.blade.php ENDPATH**/ ?>