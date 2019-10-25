<!doctype html>
<html lang="pt-br">
    <head>
        <title>Dashboard</title>
        <?php include '../head/headDashboard.php'; ?>

        <script>
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(timerGraficos);

            function timerGraficos()
            {
                setInterval(() => {
                    //Graficos;
                    var filtros = "campanha="+document.getElementById('Campanha').value+"&supervisor="+document.getElementById('Supervisor').value;
                    ajaxGraficos('pieFilaAuditoria','../sql/sqlgraficofilaespera.php',filtros);
                    ajaxGraficos('pieAuditoriaTransito','../sql/sqlgraficoemtransito.php',filtros);
                    ajaxGraficos('pieAuditoriaExecucao','../sql/sqlgraficoemexecucao.php',filtros);
                    ajaxGraficos('pieAuditoriaFinalizada','../sql/sqlgraficoauditoriafinalizada.php',filtros);

                    //Total de registros;
                    var dadosTotal = "campanha="+document.getElementById('Campanha').value+"&supervisor="+document.getElementById('Supervisor').value+'&solic=1';
                    ajaxTempos('#TotalFilaEspera','../sql/sqlTotalFilaAuditoria.php',dadosTotal);
                    ajaxTempos('#TotalEmTransito','../sql/sqlTotalEmTransito.php',dadosTotal);
                    ajaxTempos('#TotalEmExecucao','../sql/sqlTotalEmExecucao.php',dadosTotal);
                    ajaxTempos('#TotalFinalizado','../sql/sqlTotalFinalizado.php',dadosTotal);

                    //Tempo maximo;
                    var dadosMax = "campanha="+document.getElementById('Campanha').value+"&supervisor="+document.getElementById('Supervisor').value+'&solic=2';
                    ajaxTempos('#MaxTempoFilaEspera','../sql/sqlTotalFilaAuditoria.php',dadosMax);
                    ajaxTempos('#MaxTempoEmTransito','../sql/sqlTotalEmTransito.php',dadosMax);
                    ajaxTempos('#MaxTempoEmExecucao','../sql/sqlTotalEmExecucao.php',dadosMax);
                    ajaxTempos('#MaxTempoFinalizado','../sql/sqlTotalFinalizado.php',dadosMax);

                }, 1000);
            }

            //Função ajax para pegar as informações de tempos e quantidade de registros da aba de controle de auditoria
            function ajaxTempos(tabela,banco,dados){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var resultado = this.responseText;
                        $(tabela).val(resultado);
                    }
                };
                xhttp.open("GET", banco+'?'+dados, true);
                xhttp.send();
            };

            //Função ajax para criar os graficos da aba de controle de auditoria
            function ajaxGraficos(tabela,banco,filtros){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var dados = this.responseText;
                        var data = new google.visualization.DataTable(dados);
                        var options = {'title':'', 'width':450, 'height':300};
                        var chart = new google.visualization.PieChart(document.getElementById(tabela));
                        chart.draw(data, options);
                    }
                };
                xhttp.open("GET", banco+'?'+filtros, true);
                xhttp.send();
            }
        </script>
    </head>

    <body>
        <?php include '../nav/navbarAnaliticoFilas.php'; ?>

        <main role="main" class="container">
            <div class="starter-template">
                <h1>Dashboard</h1>
            </div>
        
            <div class="row">
                <div class="col-6 col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Campanha:</span>
                        <select class="form-control" method='get' id="Campanha">
                                <option value="">SELECIONE:</option>
                                <option value="CLARO_TV">CLARO TV</option>
                                <option value="COMBO_MULTI">COMBO MULTI</option>
                                <option value="NOVO_COMBO_MULTI">NOVO COMBO MULTI</option>
                                <option value="PAY_TV">PAY TV</option>
                                <option value="MARKETING_AGIL">MARKETING AGIL</option>
                        </select>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="input-group-prepend">
                    <span class="input-group-text">Supervisor:</span>
                        <select class="form-control" method='get' id="Supervisor">
                                <option value="">SELECIONE:</option>
                                <?php include '../sql/sqlListaSupervisor.php'; ?>
                            </select>
                    </div>
                </div>
            </div>
        </main>
        <!-- /.container -->
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <div class="card mb-2 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Fila de Auditoria</h5>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                   <span class="input-group-text" id="Total">Total:</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="TotalFilaEspera">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="Total">Máximo Tempo de:</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="MaxTempoFilaEspera">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Ir para o analítico:</span>
                                </div>
                                <a type="button" class="btn btn-outline-dark" href="tableAnaliticos.php">Fila Auditoria</a>
                            </div>
                            <div id="pieFilaAuditoria"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Fila em Trânsito</h5>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="Total">Total:</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="TotalEmTransito">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="Total">Máximo Tempo de:</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="MaxTempoEmTransito">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="Total">Ir para o analítico:</span>
                                </div>
                                <a type="button" class="btn btn-outline-dark" href="tableAnaliticos.php">Fila Trânsito</a>
                            </div>
                            <div id="pieAuditoriaTransito"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <div class="card mb-2 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Auditoria em Execução</h5>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="Total">Total:</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="TotalEmExecucao">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="Total">Máximo Tempo de:</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="MaxTempoEmExecucao">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="Total">Ir para o analítico:</span>
                                </div>
                                <a type="button" class="btn btn-outline-dark" href="tableAnaliticos.php">Fila Execução</a>
                            </div>
                            <div id="pieAuditoriaExecucao"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Auditoria Finalizada</h5>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="Total">Total:</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="TotalFinalizado">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="Total">Máximo Tempo de:</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="MaxTempoFinalizado">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="Total">Ir para o analítico:</span>
                                </div>
                                <a type="button" class="btn btn-outline-dark" href="tableReportAuditoriaFinalizada.php">Finalizadas</a>
                            </div>
                            <div id="pieAuditoriaFinalizada"></div>
                        </div>
                    </div>
                </div>
            </div>
        <div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../script/vendor/jquery-slim.min.js"><\/script>')</script>
        <script src="../script/vendor/popper.min.js"></script>
        <script src="../script/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="../script/script.js"></script>
    </body>
</html>
