<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// identificação do servidor, usuário e senha.
$ldap_server = "10.100.0.100";
$ldap_domain = 'motiva.matriz';
$auth_user = "usr_proc";
$auth_pass = "G6pmp?kL";
$ldap_port = "389";

// identificação da base que será acessada.
$base_dn = "CN=usr_proc,OU=Redes,OU=Tecnologia_Informacao,OU=MOTIVA,DC=motiva,DC=matriz";

// conexão com o servidor.
$connect=@ldap_connect($ldap_domain,$ldap_port);
ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION,3);
ldap_set_option($connect, LDAP_OPT_REFERRALS,0);

// conexão autentica com o servidor.
$bind=@ldap_bind($connect, $base_dn, $auth_pass);

if(!$bind)
{
    echo "erro";
}
else{
    echo "foi";
}

?>