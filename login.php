<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

define('DOMAIN_FQDN', 'motiva.matriz');
define('LDAP_SERVER', '10.100.0.100');

$auth_user = "usr_proc";
$auth_pass = "G6pmp?kL";
$ldap_port = "389";

// identificação da base que será acessada.
#$base_dn = "CN=usr_proc,OU=Redes,OU=Tecnologia_Informacao,OU=MOTIVA,DC=motiva,DC=matriz";

if (isset($_POST['submit']))
{
    $user = strip_tags($_POST['username']) .'@'. DOMAIN_FQDN;
    $pass = "G6pmp?kL";#stripslashes($_POST['password']);

    $conn = ldap_connect("ldap://". LDAP_SERVER ."/");

    if (!$conn)
        $err = 'Could not connect to LDAP server';

    else
    {
        define('LDAP_OPT_DIAGNOSTIC_MESSAGE', 0x0032);

        ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);
        #var_dump($conn);
        $bind = @ldap_bind($conn, "CN=usr_proc,OU=Redes,OU=Tecnologia_Informacao,OU=MOTIVA,DC=motiva,DC=matriz", $auth_pass);

        ldap_get_option($conn, LDAP_OPT_DIAGNOSTIC_MESSAGE, $extended_error);

        if (!empty($extended_error))
        {
            $errno = explode(',', $extended_error);
            $errno = $errno[2];
            $errno = explode(' ', $errno);
            $errno = $errno[2];
            $errno = intval($errno);
            #var_dump($bind);
            if ($errno == 532)
                $err = 'Unable to login: Password expired';
        }

        elseif ($bind)
        {
            $base_dn = array("CN=usr_proc,DC=". join(',DC=', explode('.', DOMAIN_FQDN)), 
                "ou=Redes,OU=Tecnologia_Informacao,OU=MOTIVA,DC=". join(',DC=', explode('.', DOMAIN_FQDN)));

            $result = ldap_search(array($conn,$conn), $base_dn, "(cn=*)");

            if (!count($result))
                $err = 'Unable to login: '. ldap_error($conn);

            else
            {
                foreach ($result as $res)
                {
                    $info = ldap_get_entries($conn, $res);

                    for ($i = 0; $i < $info['count']; $i++)
                    {
                        if (isset($info[$i]['userprincipalname']) AND strtolower($info[$i]['userprincipalname'][0]) == strtolower($user))
                        {
                            session_start();

                            $username = explode('@', $user);
                            $_SESSION['foo'] = 'bar';

                            // set session variables...

                            break;
                        }
                    }
                }
            }
        }
    }

    // session OK, redirect to home page
    if (isset($_SESSION['foo']))
    {
        print_r("deu certo");
        exit();
    }

    elseif (!isset($err)) $err = 'Unable to login: '. ldap_error($conn);

    ldap_close($conn);
}
?>