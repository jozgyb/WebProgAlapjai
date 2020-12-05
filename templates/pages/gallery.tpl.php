<div class="gallery">

    <a href="img/voulenteers.jpg" rel="rel1">
        <img src="img/voulenteers.jpg" alt="" title="Image 1">
    </a>

    <a href="img/voulenteers2.jpg" rel="rel1">
        <img src="img/voulenteers2.jpg" alt="" title="Image 2">
    </a>

    <a href="img/donation1.jpg" rel="rel1">
        <img src="img/donation1.jpg" alt="" title="Image 3">
    </a>

    <a href="img/team2.png" rel="rel1">
        <img src="img/team2.png" alt="" title="Image 4">
    </a>

    <script>
        var gallery = $('.gallery a').simpleLightbox({
            /* options */
        });
    </script>

    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    <?php } ?>


</div>