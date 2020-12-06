<?php
$target_dir = "img/uploads/";
$uploadOk = 1;

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "A fájl kép- " . $check["mime"] . ". \n";
        $uploadOk = 1;
    } else {
        echo "A kiválasztott fájl nem egy kép.\n";
        $uploadOk = 0;
    }


    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sajnos már létezik kép ezzel a névvel.";
        $uploadOk = 0;
    }

    // Check file size
    elseif ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sajnos a fájl mérete túl nagy.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    elseif (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Csak JPG, JPEG, PNG & GIF kiterjesztésű képek feltöltése engedélyezett.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    else if ($uploadOk == 0) {
        echo "Hiba történt.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "A következő fájl: " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " feltöltésre került";
        } else {
            echo "Hiba a felöltés közben.";
        }
    }
}
?>

<?php
$images = array();
$galleryDir = "img/uploads";
if ($handle = opendir($galleryDir)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $images[filemtime($galleryDir . "/" . $entry)] = $entry;
        }
    }

    closedir($handle);
}
ksort($images);
$iter = 0;
foreach ($images as $image) {
    if ($iter % 3 == 0) {
        echo "<div class=\"row\">";
    }
    $imgSource = $galleryDir . "/" . $image;
    echo "<div class=\"col-md-4\">\n <div class=\"thumbnail\">\n";
    echo "<a href=\"" . $imgSource . "\">\n";
    echo "<img src=\"" . $imgSource . "\" alt=\"\" style=\"width:100%\">\n";
    echo "</a>\n";
    echo "</div>\n </div>\n";
    if ($iter % 3 == 2) {
        echo "</div>\n";
    }
    $iter++;
}
?>

<script>
    var gallery = $('.thumbnail a').simpleLightbox({
        /* options */
    });
</script>

<?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <form method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Válassza ki a feltölteni kívánt képet:</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
                            <label class="custom-file-label" for="fileToUpload">Fájl kiválasztása</label>
                        </div>
                        <div class="input-group-append">
                            <input type="submit" class="input-group-text" value="Kép feltöltése" name="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

</div>