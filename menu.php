<!doctype html>
<html lang="en">
    <head>
        <title>Ferramenta de Qualidade</title>
        <?php include 'head/headMenu.php'; ?>
    </head>

    <body>
        <?php include 'nav/navbarMenu.php'; ?>
        <main role="main">
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">Ferramenta Qualidade</h1>
                    <p class="lead text-muted">Bem vindo a ferramenta de Qualidade - Motiva!</p>
                    <p class="lead text-muted">O que você deseja fazer!</p>
                </div>

                <div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row">
                            <div class="col-3">
                            </div>
                            <div class="col-3">
                                <div class="card mb-2 shadow-sm">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <img class="card-img-center" src="img/menu_pausa.jpg" alt="Card image cap">
                                        </div>
                                        <div class="btn-group">
                                            <a type="button" class="btn btn-sm btn-outline-secondary" href="form/formControlePausa.php">Pausa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card mb-2 shadow-sm">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <img class="card-img-center" src="img/menu_dashboard.jpg" alt="Card image cap">
                                        </div>
                                        <div class="btn-group">
                                            <a type="button" class="btn btn-sm btn-outline-secondary" href="table/tableDashboard.php">Dashboard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-3">
                                <div class="card mb-2 shadow-sm">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <img class="card-img-center" src="img/menu_analitico.jpg" alt="Card image cap">
                                        </div>
                                        <div class="btn-group">
                                            <a type="button" class="btn btn-sm btn-outline-secondary" href="table/tableAnaliticos.php">Analitico</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card mb-2 shadow-sm">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <img class="card-img-center" src="img/menu_report.jpg" alt="Card image cap">
                                        </div>
                                        <div class="btn-group">
                                            <a type="button" class="btn btn-sm btn-outline-secondary" href="table/tableReportAuditoriaFinalizada.php">Report</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-3">
                                <div class="card mb-2 shadow-sm">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <img class="card-img-center" src="img/menu_finalturno.png" alt="Card image cap">
                                        </div>
                                        <div class="btn-group">
                                            <a type="button" class="btn btn-sm btn-outline-secondary" href="table/tableListaStatusAuditor.php">Final de Turno</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-3">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="text-muted">
            <div class="container">
                <p class="float-right"> <a href="#">Voltar ao Topo</a> </p>
                <p></p>
                <p></p>
            </div>
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
