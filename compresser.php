<?php
function compressImage($source, $destination, $quality) {
    // Charger l'image
    $image = imagecreatefromjpeg($source);

    if ($image === false) {
        return false;
    }

    // Sauvegarder l'image compressée
    $result = imagejpeg($image, $destination, $quality);

    // Libérer la mémoire
    imagedestroy($image);

    return $result;
}
?>
