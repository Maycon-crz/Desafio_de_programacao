<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Desafio - <?= $title; ?></title>    
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= url("/theme/assets/css/style.css"); ?>"/>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Desafio de programação</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">                    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastros e Edições
                            </a>
                            <ul class="dropdown-menu justify-content-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Cadastros de Unidades de um condomínio</a></li>
                                <li><a class="dropdown-item" href="#">Edição de Unidades de um condomínio</a></li>
                                <li><a class="dropdown-item" href="#">Cadastros de inquilinos</a></li>
                                <li><a class="dropdown-item" href="#">Edição de inquilinos</a></li>                            
                            </ul>
                        </li>                    
                    </ul>
                </div>
            </div>
        </nav>
        <main class="container-fluid">
            <?= $v->section("content"); ?>
        </main>
        <script src="<?= url("/theme/assets/js/jquery.js"); ?>"></script>
        <?= $v->section("js"); ?>
        <!-- Javascrip bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- --- -->
    </body>
</html>