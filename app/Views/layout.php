<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?=$this->e($title)?></title>
    <!-- <link rel="stylesheet" href="<?= $basePath ?>assets/css/reset.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/brands.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= $basePath ?>assets/css/custom-bootstrap.css">
    <link rel="stylesheet" href="<?= $basePath ?>assets/css/style.css">

    <script>
    var BASE_PATH = "<?= $basePath ?>";
    </script>
  </head>
  <body>

    <header>
        <?=$this->insert('partials/nav')?>
    </header>
    <main>
        <?=$this->section('content')?>
    </main>
    <footer>
        <div class="text-center">Copyright &copy; Oquiz 2018</div>
    </footer>

    <!-- Inclusion de jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Inclusion du fichier app.js -->
    <script src="<?= $basePath ?>assets/js/app.js"></script>
  </body>
</html>
