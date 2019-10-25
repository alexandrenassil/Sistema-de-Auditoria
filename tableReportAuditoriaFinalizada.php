<!doctype html>
<html lang="pt-br">
    <head>
        <title>Auditoria Finalizada</title>
        <?php include '../head/headAnaliticoFilas.php'; ?>

        <script>
            var temp;
            function Finalizado(id){
                var stop = id;
                var tabela = '#dadosTabela';
                var banco = '../sql/sqlReportAuditoriaFinalizada.php'
                var dados = 'data='+document.getElementById('fitroData').value+'&supervisor='+document.getElementById('filtroSupervisor').value;
                timerTable(tabela,banco,dados,stop);
            }
        </script>
    </head>

    <body onload="Finalizado(0)">
        <?php include '../nav/navbarReport.php'; ?>

        <main role="main" class="container">
            <div class="starter-template">
                <h1>Auditoria Finalizada</h1>
            </div>
            <div class="row">
                <div class="col-6 col-md-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Data">Data:</span>
                        <select class="form-control" method='get' type="submit" id="fitroData" onChange="Finalizado(1)">
                            <option value="<?php echo date('d/m/Y'); ?>"><?php echo date('d/m/Y'); ?></option>
                            <option value="<?php echo date('d/m/Y',strtotime('-1 day')); ?>"><?php echo date('d/m/Y',strtotime('-1 day')); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-6 col-md-8">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Campanha">Supervisor:</span>
                        <select class="form-control" method='get' type="submit" id="filtroSupervisor" onChange="Finalizado(1)">
                            <option value="">SELECIONE:</option>
                            <?php include '../sql/sqlListaSupervisor.php'; ?>
                        </select>
                    </div>
                </div>
            </div>
        </main>
        <br>
        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table table-striped table-sm" name="tabela" id="tabela" metod="get">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Indice</th>
                            <th>Campanha</th>
                            <th>Auditor</th>
                            <th>Operador</th>
                            <th>Supervisor</th>
                            <th>Espera</th>
                            <th>Em Transito</th>
                            <th>Auditoria</th>
                            <th>Status</th>
                            <th>Substatus</th>
                            <th>Ultima Auditoria Contrato</th>
                        </tr>
                    </thead>
                    <tbody id="dadosTabela"></tbody>
                </table>
            </div>
        </div>

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
