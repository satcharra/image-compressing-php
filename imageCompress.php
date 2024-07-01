<?php
require 'compresser.php';

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageTmpPath = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    $uploadDir = 'uploads/';

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $imagePath = $uploadDir . $imageName;

    if (move_uploaded_file($imageTmpPath, $imagePath)) {
        $compressionQuality = isset($_POST['quality']) ? intval($_POST['quality']) : 75;
        $compressedImagePath = $uploadDir . 'compressed_' . $imageName;

        if (compressImage($imagePath, $compressedImagePath, $compressionQuality)) {
            echo 'Image compressée avec succès. <a href="' . $compressedImagePath . '">Télécharger l\'image compressée</a>';
        } else {
            echo 'Erreur: Impossible de compresser l\'image.';
        }
    } else {
        echo 'Erreur: Impossible de déplacer le fichier téléchargé.';
    }
} else {
    echo 'Erreur: Aucun fichier téléchargé.';
}
?>
