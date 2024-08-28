/* N'oublie pas l'installation de la bibliothèque gd :

sudo apt-get install php-gd

suivi du redémarrage d'apache2 :

sudo systemctl restart apache2

*/

<?php
function resize_image($image_path, $new_width, $new_height, $maintain_ratio = true) {
    # On vérifie si le fichier existe
    if (!file_exists($image_path)) {
        echo "Le fichier spécifié est introuvable : $image_path\n";
        return;
    }

    // On récupère l'extension du fichier
    $extension = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));

    // On ouvre l'image à l'aide de GD en fonction du type de fichier

    // syntaxe php 7 et antérieur
    /*
    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            $original_image = imagecreatefromjpeg($image_path);
            break;
        case 'png':
            $original_image = imagecreatefrompng($image_path);
            break;
        case 'gif':
            $original_image = imagecreatefromgif($image_path);
            break;
        case 'webp':
            $original_image = imagecreatefromwebp($image_path);
            break;
        default:
            echo "Format d'image non supporté. Seuls les formats JPG, PNG, GIF, et WebP sont pris en charge.\n";
            return;
    }
    */

    // depuis php 8
    $original_image = match($extension) {
        'jpg', 'jpeg' => imagecreatefromjpeg($image_path),
        'png' => imagecreatefrompng($image_path),
        'gif' => imagecreatefromgif($image_path),
        'webp' => imagecreatefromwebp($image_path),
        default => null,
    };
    
    if ($original_image === null) {
        echo "Format d'image non supporté. Seuls les formats JPG, PNG, GIF, et WebP sont pris en charge.\n";
        return;
    }


    // On obtient les dimensions de l'image originale
    list($original_width, $original_height) = getimagesize($image_path);

    // On calalcule le ratio pour respecter la proportion de l'image originale
    if ($maintain_ratio) {
        $ratio = min($new_width / $original_width, $new_height / $original_height);
        $resized_width = intval($original_width * $ratio);
        $resized_height = intval($original_height * $ratio);
    } else {
        // L'utilisateur souhaite déformer l'image : on applique directement les nouvelles dimensions
        $resized_width = $new_width;
        $resized_height = $new_height;
    }

    // On crée une nouvelle image redimensionnée
    $resized_image = imagecreatetruecolor($resized_width, $resized_height);
    imagecopyresampled($resized_image, $original_image, 0, 0, 0, 0, $resized_width, $resized_height, $original_width, $original_height);

    // On Génère le nouveau nom de fichier avec la date et l'heure actuelles
    $current_time = date("YmdHis");
    $path_info = pathinfo($image_path);
    $resized_image_name = $path_info['filename'] . "_Php_" . "_$current_time." . $path_info['extension'];
    $resized_image_path = $path_info['dirname'] . "/" . $resized_image_name;

    // On enregistre l'image redimensionnée en fonction du type
    /* php 7
    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($resized_image, $resized_image_path);
            break;
        case 'png':
            imagepng($resized_image, $resized_image_path);
            break;
        case 'gif':
            imagegif($resized_image, $resized_image_path);
            break;
        case 'webp':
            imagewebp($resized_image, $resized_image_path);
            break;
    }
    */

    try {
        match ($extension) {
            'jpg', 'jpeg' => imagejpeg($resized_image, $resized_image_path),
            'png' => imagepng($resized_image, $resized_image_path),
            'gif' => imagegif($resized_image, $resized_image_path),
            'webp' => imagewebp($resized_image, $resized_image_path),
            default => throw new Exception("Format d'image non supporté."),
        };
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    

    // On libère la mémoire
    imagedestroy($original_image);
    imagedestroy($resized_image);

    echo "Image enregistrée sous : $resized_image_path\n";
}






if (php_sapi_name() == "cli") {
    // On demande à l'utilisateur le chemin de l'image
    echo "Entrez le chemin de l'image : ";
    $image_path = trim(fgets(STDIN));

    // On demande la nouvelle largeur et hauteur
    echo "Entrez la nouvelle largeur (max) : ";
    $new_width = intval(trim(fgets(STDIN)));

    echo "Entrez la nouvelle hauteur (max) : ";
    $new_height = intval(trim(fgets(STDIN)));

    // On demande à l'utilisateur s'il souhaite maintenir le ratio
    echo "Voulez-vous maintenir le ratio d'aspect ? (oui/non) : ";
    $maintain_ratio_input = trim(fgets(STDIN));
    $maintain_ratio = strtolower($maintain_ratio_input) == "oui";

    // On redimensionne l'image
    resize_image($image_path, $new_width, $new_height, $maintain_ratio);
}
?>
