<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $pageTitle['title'] ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="."><img src="<?= $header['imgsrc'] ?>"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarResponsive" aria-controls="navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <?php foreach ($pages as $url => $page) { ?>
                        <li<?= (($page == $requestedPage) ? ' class="nav-item active"' : '') ?>>
                            <a class="nav-link" href="<?= ($url == '/') ? '.' : $url ?>">
                                <?= $page['text'] ?></a>
                            </li>
                        <?php } ?>
                </ul>
            </div>
        </div>

    </nav>

    <div class="container-fluid" id="content-wrapper">
        <?php include("./templates/pages/{$requestedPage['file']}.tpl.php"); ?>
    </div>

    <!--- Image Slider -->


    <!--- Jumbotron -->


    <!--- Welcome Section -->


    <!--- Three Column Section -->


    <!--- Two Column Section -->


    <!--- Fixed background -->


    <!--- Emoji Section -->


    <!--- Meet the team -->


    <!--- Cards -->


    <!--- Two Column Section -->


    <!--- Connect -->


    <!--- Footer -->




</body>

</html>