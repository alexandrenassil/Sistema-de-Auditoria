<!doctype html>
<html lang="pt-br">
    <head>
        <title>Controle de Pausa</title>
        <?php include '../head/headAnaliticoFilas.php'; ?>

        <script>
            function ajax(tabela,banco,dados){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.querySelector(tabela).innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", banco+'?'+dados, true);
                xhttp.send();
            };


            function HabilitaCampos(item){
                var campo = item;
                var dados = 'tipoFunc='+campo;
                if(campo == 1)
                {
                    document.getElementById('Campanha').style.display = "none";
                    document.getElementById('Ambiente').style.display = "none";
                    document.getElementById('CampanhaAuditor').style.display = "none";
                    document.getElementById('AmbienteAuditor').style.display = "none";
                }
                else
                {
                    document.getElementById('Campanha').style.display = "inline";
                    document.getElementById('Ambiente').style.display = "inline";
                    document.getElementById('CampanhaAuditor').style.display = "inline";
                    document.getElementById('AmbienteAuditor').style.display = "inline";
                }
                ajax('#StatusAuditor','../sql/sqlListaPausa.php',dados);
                }
        </script>
    </head>

    <body>
        <?php include '../nav/navbarControlePausa.php'; ?>

        <main role="main" class="container">
            <div class="starter-template">
                <h1>Controle de Pausa</h1>
            </div>
            <div class="album py-5 bg-light text-center">
                <section>
                    <form method="post" action="../sql/sqlPesquisaNome.php">

                        <label class="radio-inline">
                            <input type="radio" name="rdAuditor" value="0" onchange="HabilitaCampos(0)">Auditor
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="rdAuditor" value="1" onchange="HabilitaCampos(1)">Monitor
                        </label>

                        <div class="input-group mb-3 col-md-6 offset-md-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="Login">Login:</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" requred name="LoginAuditor">
                        </div>

                        <div class="input-group mb-3 col-md-6 offset-md-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="Senha">Senha:</span>
                            </div>
                            <input type="password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" requred name="SenhaAuditor">
                        </div>

                        <div class="input-group mb-3 col-md-6 offset-md-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="Status">Status:</span>
                            </div>
                            <select class="form-control" name="StatusAuditor" id="StatusAuditor">
                                <option value="">SELECIONE:</option>
                            </select>
                        </div>

                        <div class="input-group mb-3 col-md-6 offset-md-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="Campanha">Campanha:</span>
                            </div>
                            <select class="form-control" name="CampanhaAuditor" id="CampanhaAuditor">
                                <option value="">SELECIONE:</option>
                                <option value="CLARO_TV">CLARO TV</option>
                                <option value="COMBO_MULTI">COMBO MULTI</option>
                                <option value="NOVO_COMBO_MULTI">NOVO COMBO MULTI</option>
                                <option value="PAY_TV">PAY TV</option>
                                <option value="MARKETING_AGIL">MARKETING AGIL</option>
                            </select>
                        </div>

                        <div class="input-group mb-3 col-md-6 offset-md-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="Ambiente">Ambiente:</span>
                            </div>
                            <select class="form-control" name="AmbienteAuditor" id="AmbienteAuditor">
                                <option value="">SELECIONE:</option>
                                <option value="AMBIENTE_55">AMBIENTE 55</option>
                                <option value="AMBIENTE_30">AMBIENTE 30</option>
                            </select>
                        </div>

                        <div class="btn-group">
                            <button type="submit" class="btn btn-outline-secondary">Finalizar</button>
                        </div>

                    </form>
                </section>
            </div>
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
