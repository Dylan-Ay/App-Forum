<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
    <script src="https://kit.fontawesome.com/aadee783c9.js" crossorigin="anonymous"></script>
    <title> <?php if (isset($title)): echo $title; endif;?> </title>
</head>
<body>
    
    <!-------- HEADER -------->

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 py-lg-0">
            <div class="container">
                <div class="row align-items-center mb-1">
                    <div class="col d-flex">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="col">
                        <a class="navbar-brand" href="index.php?ctrl=home">Forum</a>
                    </div>
                </div>
                <div class="row flex-nowrap align-items-center order-lg-1">
                    <div class="col d-flex align-items-end login-container">
                        <?php if($session->getUser()): ?>
                            
                            <a class='nav-link' href='index.php?ctrl=security&action=logout'>Se deconnecter</a>

                        <?php else: ?>

                            <a class='nav-link' href='index.php?ctrl=security&action=login'>Connexion</a>
                            
                        <?php endif;?>
                    </div>
                </div>
                <div class="collapse navbar-collapse navbar-dark bg-dark justify-content-center" id="navbarNav">
                    <ul class="navbar-nav justify-content-evenly align-items-center pt-4 pb-lg-4 flex-md-row">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php?ctrl=home">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?ctrl=forum&action=listCategories">Catégories</a>
                        </li>
                        <?php if(App\Session::isAdmin()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?ctrl=user&action=listUsers">Utilisateurs</a>
                            </li>
                        <?php endif;?>
                        
                        <?php if(App\Session::getUser()):?>

                            <li class="nav-item">
                                <a class="nav-link" href="index.php?ctrl=security&action=detailAccount">Mon Profil</a>
                            </li>

                        <?php endif;?>

                        <?php if(!App\Session::getUser()): ?>

                            <li class="nav-item">
                                <a class='nav-link' href='index.php?ctrl=security&action=registerForm'>S'inscrire</a>
                            </li>

                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-------- MAIN -------->

        <main class="container py-5">
            <h1 class="text-center mb-5">
                <?php if (isset($h1)): echo $h1; endif;?>
            </h1>

            <?= $page ?>
            
        </main>

        <!------- FOOTER ------->
    <footer class="container">
        <p>
            &copy; 2020 - Forum CDA - <a href="/home/forumRules.html">Règlement du forum</a> - <a href="">Mentions légales</a>
        </p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="public/js/app.js"></script>
</body>
</html>