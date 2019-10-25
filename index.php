<!doctype html>
<html lang="pt-br">
    <head>
        <title>Login Qualidade</title>
        <?php include 'head/headIndex.php'; ?>
    </head>

    <body>
        <?php include 'nav/navbarIndex.php'; ?>

        <main role="main" class="container">
            <div class="starter-template">
                <h1>Ferramenta Qualidade</h1>
            </div>

            <form action="menu.php" method="post">

                <section class="jumbotron text-center">
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Id Auditor:</span>
                                </div>
                                <input id="login" name="login" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="required">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Senha:</span>
                                </div>
                                <input id="senha" name="senha" type="password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="required">
                            </div>

                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary btn-outline-secondary">Log in</button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>
                </section>

            </form>

        </main>
        <br>
        <div class="container-fluid">

        </div>
        <footer class="container-fluid text-center">
            <p></p>
        </footer>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="script/vendor/jquery-slim.min.js"><\/script>')</script>
        <script src="script/vendor/popper.min.js"></script>
        <script src="script/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="script/script.js"></script>
    </body>
</html>
