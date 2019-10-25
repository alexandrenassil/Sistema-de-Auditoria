<?php
$id=$_GET['id'];

#substr($id,0,strstr($id,'|'))

echo '

    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">INICIAR AUDITORIA?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="../sql/sqlInsertEmTransito.php">
                    <div class="form-group">
                        <label>Id da venda</label><br>
                        <input type="text" id="Id" name="Id" class="form-control" placeholder="Id" value='.$id.' readonly=“true”>
                    </div>
                    <div class="form-group">
                        <label>Ambiente</label><br>
                        <select id="ambiente" name="cbAmbiente" class="form-control" placeholder="Ambiente">
                            <option value="AMBIENTE_55">AMBIENTE 55</option>
                            <option value="AMBIENTE_30">AMBIENTE 30</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Login Auditor</label><br>
                        <input type="text" id="login" name="txLogin" class="form-control" placeholder="Login" value="">
                    </div>
                    <div class="form-group">
                        <label>Senha Auditor</label><br>
                        <input type="password" id="senha" name="txSenha" class="form-control" placeholder="Senha" value="">
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <div class="col-3 col-md-3">
                            <input type="submit" class="btnSubmit btn-primary" value="Iniciar">
                        </div>
                </form>
                        <div class="col-3 col-md-3">
                        </div>
                        <div class="col-3 col-md-3">
                        </div>
                        <div class="col-3 col-md-3">
                            <form action="tableAnaliticos.php">
                                <input type="submit" class="btnSubmit btn-secondary" value="Cancelar" >
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>';
?>