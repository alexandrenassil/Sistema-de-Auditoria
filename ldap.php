<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
print_r(phpinfo());
$username = 'usr_proc';
$password = 'G6pmp?kL';

$ldapconfig['host'] = '10.100.0.100';
$ldapconfig['domain'] = 'motiva.matriz';
$ldapconfig['port'] = 389;
$ldapconfig['basedn'] = 'dc=motiva,dc=matriz';

$ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);
$dn="uid=".$username.",ou=Redes,OU=Tecnologia_Informacao,OU=MOTIVA,".$ldapconfig['basedn'];

ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION,3);
ldap_set_option($ds, LDAP_OPT_REFERRALS,0);

if ($bind=ldap_bind($ds, $dn, $password)) {
  echo("Login correct");
} else {

  echo("Unable to bind to server.</br>");

  echo("msg:'".ldap_error($ds)."'</br>");
  if ($bind=ldap_bind($ds)) {

    $filter = "(cn=*)";

    if (!($search=@ldap_search($ds, $ldapconfig['basedn'], $filter))) {
      echo("Unable to search ldap server<br>");
      echo("msg:'".ldap_error($ds)."'</br>");
    } else {
      $number_returned = ldap_count_entries($ds,$search);
      $info = ldap_get_entries($ds, $search);
      echo "The number of entries returned is ". $number_returned."<p>";
      for ($i=0; $i<$info["count"]; $i++) {

        var_dump($info[$i]);
      }
    }
  } else {
    echo("Unable to bind anonymously<br>");
    echo("msg:".ldap_error($ds)."<br>");
  }
}

?>