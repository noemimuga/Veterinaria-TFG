<?php
/**
 * SCRIPT PARA DESCARGAR IMÁGENES para desarrollo local
 */

if (!file_exists('artisan')) {
    die("ERROR: Este script debe estar en la raíz de tu proyecto Laravel\n");
}
 
$ruta = 'storage/app/public/animales';
if (!file_exists($ruta)) {
    mkdir($ruta, 0755, true);
    echo "Carpeta creada: {$ruta}\n\n";
}
 
// URLs simples 
$imagenes = [
    'perro1.jpg' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?w=800&q=80',
    'perro2.jpg' => 'https://images.unsplash.com/photo-1633722715463-d30f4f325e24?w=800&q=80',
    'perro3.jpg' => 'https://images.unsplash.com/photo-1568572933382-74d440642117?w=800&q=80',
    'perro4.jpg' => 'https://images.unsplash.com/photo-1505628346881-b72b27e84530?w=800&q=80',
    'perro5.jpg' => 'https://images.unsplash.com/photo-1605568427561-40dd23c2acea?w=800&q=80',
    'gato1.jpg' => 'https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?w=800&q=80',
    'gato2.jpg' => 'https://images.unsplash.com/photo-1574158622682-e40e69881006?w=800&q=80',
    'gato3.jpg' => 'https://images.unsplash.com/photo-1592194996308-7b43878e84a6?w=800&q=80',
    'gato4.jpg' => 'https://images.unsplash.com/photo-1611267254323-4db7b39c732c?w=800&q=80',
    'gato5.jpg' => 'https://images.unsplash.com/photo-1595433707802-6b2626ef1c91?w=800&q=80',
];
 
$descargadas = 0;
$errores = 0;
 
// Crear contexto de stream con SSL deshabilitado (solo para desarrollo)
$contexto = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
    'http' => [
        'timeout' => 30,
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
        'ignore_errors' => true,
    ]
]);
 
foreach ($imagenes as $nombre => $url) {
    echo "Descargando {$nombre}... ";
    
    try {
        $contenido = @file_get_contents($url, false, $contexto);
        
        if ($contenido === false) {
            echo "Error\n";
            $errores++;
            continue;
        }
        
        $archivo_destino = "{$ruta}/{$nombre}";
        if (file_put_contents($archivo_destino, $contenido)) {
            echo "OK\n";
            $descargadas++;
        } else {
            echo " Error al guardar\n";
            $errores++;
        }
        
        sleep(1);
        
    } catch (Exception $e) {
        echo " {$e->getMessage()}\n";
        $errores++;
    }
}
 
