<!doctype html>
<html lang="pt-br">
    <head>
        <title>Fila Auditoria</title>
        <?php include '../head/headAnaliticoFilas.php'; ?>

        <script>
            function ajaxModal(id){
                var indice = id;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.querySelector('#myModal').innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", 'modal.php?id='+indice, true);
                xhttp.send();
            }

            var temp;
            function filaAuditoria(id){
                var stop = id;
                var tabela = '#dadosTabela';
                var banco = '../sql/sqlFilaAuditoria.php'
                var dados = 'campanha='+document.getElementById('fitroCampanha').value+'&supervisor='+document.getElementById('filtroSupervisor').value;
                timerTable(tabela,banco,dados,stop);
                if(stop==1)
                {
                    clearInterval(temp);
                    stop = 0;
                }
                temp = setInterval(() => {
                    var TotalId = '#TotalFilaEspera';
                    var TotalBanco = '../sql/sqlTotalFilaAuditoria.php';
                    var totalDados = dados+'&solic=1';
                    ajaxTempos(TotalId,TotalBanco,totalDados);
                }, 1000);
            }
        </script>
    </head>

    <body onload="filaAuditoria(0)">
        <?php include '../nav/navbarAnaliticoFilas.php'; ?>

        <main role="main" class="container">
            <div class="starter-template">
                <h1>Fila de Auditoria</h1>
            </div>
            <div class="row">
                <div class="col-6 col-md-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Campanha">Total:</span>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="TotalFilaEspera">
                    </div>
                </div>
                <div class="col-6 col-md-5">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Campanha">Campanha:</span>
                        <select class="form-control" method='get' type="submit" id="fitroCampanha" onChange="filaAuditoria(1)">
                            <option value="">SELECIONE:</option>
                            <option value="CLARO_TV">CLARO TV</option>
                            <option value="COMBO_MULTI">COMBO MULTI</option>
                            <option value="NOVO_COMBO_MULTI">NOVO COMBO MULTI</option>
                            <option value="PAY_TV">PAY TV</option>
                            <option value="MARKETING_AGIL">MARKETING AGIL</option>
                        </select>
                    </div>
                </div>
                <div class="col-6 col-md-5">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Campanha">Supervisor:</span>
                        <select class="form-control" method='get' type="submit" id="filtroSupervisor" onChange="filaAuditoria(1)">
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
            <div class="table-responsive">
                <table class="table table-striped table-sm" name="tabela" id="tabela" metod="get"  font-size="1rem">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Indice</th>
                            <th>Campanha</th>
                            <th>Supervisor</th>
                            <th>Tempo Espera</th>
                            <th>Farol</th>
                            <th>Reprova</th>
                            <th>Auditar</th>
                        </tr>
                    </thead>
                    <tbody id="dadosTabela"></tbody>
                </table>
            </div>
            <div class="modal fade" id="myModal" role="dialog" method='get'></div>
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
