<?php $__env->startSection('content'); ?>
<div class="container-dinamico">
    <h1 class="titulo">Preguntas Frecuentes</h1>

    <div class="card-box" onclick="toggleFaq(1)">
        <h3>¿Cómo adoptar?</h3>
        <p id="faq1" class="hidden">Registrarte, elegir animal y enviar solicitud.</p>
    </div>

    <div class="card-box" onclick="toggleFaq(2)">
        <h3>¿Tiene coste?</h3>
        <p id="faq2" class="hidden">Sí, para cubrir gastos veterinarios.</p>
    </div>

    <div class="card-box" onclick="toggleFaq(3)">
        <h3>¿Puedo visitarlo?</h3>
        <p id="faq3" class="hidden">Sí, con cita previa.</p>
    </div>
</div>

<script>
function toggleFaq(id) {
    let el = document.getElementById("faq" + id);
    el.classList.toggle("hidden");
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Veterinaria-TFG\resources\views/faq.blade.php ENDPATH**/ ?>