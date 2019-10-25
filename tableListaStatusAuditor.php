<!doctype html>
<html lang="pt-br">
    <head>
        <title>Controle de Pausa Auditor</title>
        <?php include '../head/headAnaliticoFilas.php'; ?>

        <script>
           var temp;
            function ListaAuditores(id){
                var stop = id;
                var tabela = '#dadosTabela';
                var banco = '../sql/sqlListaAuditores.php'
                var dados = 'campanha='+document.getElementById('fitroCampanha').value+'&acao=1';
                ajax(tabela,banco,dados);
            }

            function coletaDados(){
                var ids = document.getElementsByClassName('form-check-input');
                //coletaIDs(ids);
                console.log(ids);
            }

            function coletaIDs(dados){
                var array_dados = dados;
                var newArray = [];
                for(var x = 0; x <= array_dados.length; x++){
                    if(typeof array_dados[x] == 'object'){
                        if(array_dados[x].checked){
                            newArray.push(array_dados[x].id);
                            console.log(newArray);
                        }
                    }
                }

            }
        </script>
    </head>

    <body onload="ListaAuditores(0)">
        <?php include '../nav/navbarReport.php'; ?>

        <main role="main" class="container">
            <div class="starter-template">
                <h1>Controle de Pausa Auditor</h1>
            </div>
            <div class="row">
                <div class="col-6 col-md-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Campanha">Filtro Campanha:</span>
                        <select class="form-control" method='get' type="submit" id="fitroCampanha" onChange="ListaAuditores(1)">
                            <option value="">SELECIONE:</option>
                            <option value="CLARO_TV">CLARO TV</option>
                            <option value="COMBO_MULTI">COMBO MULTI</option>
                            <option value="NOVO_COMBO_MULTI">NOVO COMBO MULTI</option>
                            <option value="PAY_TV">PAY TV</option>
                            <option value="MARKETING_AGIL">MARKETING AGIL</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <form method='post' name='myForm' id='myForm' action='../sql/sqlInsertFimdeTurno.php'>

                <div class="row">
                    <div class="col-6 col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Campanha">Alterar Status:</span>
                            <select class="form-control" name="filtroStatus">
                                <?php include '../sql/sqlListaPausa.php';?>
                            </select>
                        </div>
                    </div>
                </div>

                <br>
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm" name="tabela" id="tabela" metod="get">
                            <thead>
                                <tr>
                                    <th>Login</th>
                                    <th>Nome</th>
                                    <th>Ambiente</th>
                                    <th>Campanha</th>
                                    <th>Status</th>
                                    <th>Ultima Alteracao</th>
                                    <th>Alterar Status?</th>
                                </tr>
                            </thead>
                            <tbody id="dadosTabela"></tbody>
                        </table>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-sm btn-outline-secondary">Salvar</a>
                    </div>
                </div>
            </form>
        </main>

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
