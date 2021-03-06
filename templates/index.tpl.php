<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $pageTitle['title'] ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="includes/simple-lightbox.min.js"></script>
    <script src="includes/simple-lightbox.legacy.min.js"></script>
    <script src="includes/simple-lightbox.jquery.min.js"></script>
    <link href="style.css" rel="stylesheet">
    <link href="includes/simple-lightbox.min.css" rel="stylesheet" />
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
                    <?php $currentPages = adjustMenuOnLogin($defaultPages); ?>
                    <?php foreach ($currentPages as $url => $page) { ?>
                        <li<?= (($page == $requestedPage) ? ' class="nav-item active"' : '') ?>>
                            <a class="nav-link" href="<?= ($url == '/') ? '.' : $url ?>">
                                <?= $page['text'] ?></a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="https://csodacsoport.hu/"> Original site</a>
                        </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
        <div class="container-fluid">
            <div id="loginstatus" class="row">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
                    <p>
                        Logged in as: <?php echo $_SESSION["lastname"] . " " . $_SESSION["firstname"] . " (" . $_SESSION["username"] . ")"; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="container-fluid" id="content-wrapper">
        <?php include("./templates/pages/{$requestedPage['file']}.tpl.php"); ?>
    </div>


</body>

</html>