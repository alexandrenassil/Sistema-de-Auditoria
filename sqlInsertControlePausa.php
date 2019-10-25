<?php session_start();
    include "../conexoes/conexao_ambiente121.php";

    #$nome = $_POST['Nome'];
    #$login = $_POST['LoginAuditor'];
    #$senha = $_POST['SenhaAuditor'];
    #$status = $_POST['StatusAuditor'];
    #$campanha = $_POST['CampanhaAuditor'];
    #$ambiente = $_POST['AmbienteAuditor'];
    #$tipoFunc = $_POST['rdAuditor'];

    $nome = $_SESSION['Nome'];
    $login =  $_SESSION['LoginAuditor'];
    $senha = $_SESSION['SenhaAuditor'];
    $status = $_SESSION['StatusAuditor'];
    $campanha = $_SESSION['CampanhaAuditor'];
    $ambiente = $_SESSION['AmbienteAuditor'];
    $tipoFunc = $_SESSION['rdAuditor'];


    if(trim($login) == "" || strlen($login) > 4)
    {
        echo "<script>alert('Preencha o campo login corretamente!');document.location='../form/formControlePausa.php'</script>";
    }
    else if (trim($senha) == "" || strlen($senha) > 4)
    {
        echo "<script>alert('Preencha o campo senha corretamente!');document.location='../form/formControlePausa.php'</script>";
    }
    else if ($status == "")
    {
        echo "<script>alert('Preencha o campo status!');document.location='../form/formControlePausa.php'</script>";
    }
    else if ($campanha == "" && $tipoFunc == 0)
    {
        echo "<script>alert('Preencha o campo campanha!');document.location='../form/formControlePausa.php'</script>";
    }
    else if ($ambiente == "" && $tipoFunc == 0)
    {
        echo "<script>alert('Preencha o campo ambiente!');document.location='../form/formControlePausa.php'</script>";
    }
    else{


        $script = "SELECT COUNT(1) qtd FROM [AUDITORIA_VENDAS].[DBO].[TABELA_PAUSAS] WHERE LOGIN_AUDITOR = '".$login."' AND COD_STATUS = 1 AND DATEDIFF(D, DATA, GETDATE()) = 0";
        $result = mssql_query($script);
        $ValidaPausa = mssql_fetch_array($result);

        if(($ValidaPausa['qtd'] == "0" || $ValidaPausa['qtd'] == "") && $status != "1")
        {
            echo "<script>alert('É necessario inserir o status de INÍCIO DE TURNO antes de adicionar uma pausa');document.location='../form/formControlePausa.php'</script>";
        }
        else
        {
            $script = "SELECT COD_STATUS FROM [AUDITORIA_VENDAS].[DBO].[TABELA_PAUSAS] AS A JOIN (SELECT MAX(DATA) ultimo_Status FROM [AUDITORIA_VENDAS].[DBO].[TABELA_PAUSAS] WHERE LOGIN_AUDITOR = '".$login."' AND DATEDIFF(D, DATA, GETDATE()) = 0) AS B ON A.DATA = B.ultimo_Status WHERE LOGIN_AUDITOR = '".$login."'";
            $result = mssql_query($script);
            $Pausas = array("10","11","12","13","15","20","25","30","31","40","45","50","55","60");
            $UltimaPausa = 0;
            $ValidaUltimaPausa = mssql_fetch_array($result);

            foreach($Pausas as $cod)
            {

                if($cod == $ValidaUltimaPausa['COD_STATUS'])
                {
                    $UltimaPausa = 1;
                }
            }
            if(($UltimaPausa == 1 && $status == 5) || $status != 5)
            {

                if(trim($nome) != "")
                {

                    $script = "INSERT INTO [Auditoria_Vendas].[dbo].[TABELA_PAUSAS] (LOGIN_AUDITOR, COD_STATUS, CAMPANHA, AMBIENTE, DATA, NOME_AUDITOR) VALUES ('".$login."','".$status."','".$campanha."','".$ambiente."', GETDATE(), '".$nome."')";
                    #$validacao = mssql_fetch_array($result);

                    if(mssql_query($script))
                    {
                        echo "<script>alert('Status inserido com sucesso!');document.location='../form/formControlePausa.php'</script>";
                    }
                    else
                    {

                        echo "<script>alert('Nao foi possivel validar a autenticacao!');document.location='../form/formControlePausa.php'</script>";
                    }

                }
                else
                {
                    echo "<script>alert('Login ou senha invalido!');document.location='../form/formControlePausa.php'</script>";
                }
            }
            else
            {
                echo "<script>alert('Só é possivel colocar o status DISPONIVEL após sair de pausa.');document.location='../form/formControlePausa.php'</script>";
            }
        }

    }
?>