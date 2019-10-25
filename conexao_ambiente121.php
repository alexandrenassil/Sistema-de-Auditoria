<?php
    $conector = mssql_connect("10.100.0.121", "web_scripter", "w3b_scr1pt3r") or die("NÃO FOI POSSÍVEL A CONEXÃO COM O SERVIDOR");
    $conn = mssql_select_db("Auditoria_Vendas", $conector) or die("NÃO FOI POSSÍVEL SELECIONAR O BANCO DE DADOS");
?>