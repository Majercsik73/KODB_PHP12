<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <title> KODB_PHP12</title>
</head>

<body>
    <nav class="navbar navbar-expand navbar-light bg-danger">
        <div class="navbar-nav">
            <a class="nav-item nav-link <?php echo $params['activeLink'] === "KODB_PHP12/" ? "active" : "" ?>" href="/KODB_PHP11/">
                Címlap
            </a>
            <a class="nav-item nav-link <?php echo $params['activeLink'] === "KODB_PHP12/termekek" ? "active" : "" ?>" href="/KODB_PHP11/termekek">
                Termékek
            </a>
        </div>
    </nav>
        <?php echo $params['innerTemplate']?>
    <footer class="bg-danger text-center fixed-bottom text-lg-start">
        <div class="text-center p-3">
            Footer tartalom
        </div>
    </footer>
</body>

</html>