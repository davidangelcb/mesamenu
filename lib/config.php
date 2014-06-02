<?php
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

date_default_timezone_set('America/Lima');
// ENCODIFICACION DEL CHARSET
header("Content-Type: text/html; charset=UTF-8");
//header("Content-Type: text/html; charset=iso-8859-1\r\n");
ini_set('zend.ze1_compatibility_mode', 0);
// REPORTE DE ERRORES AL CLIENTE (para depuracion)
ini_set('error_reporting', E_ALL);
if (APPLICATION_ENV == 'production' || defined('RUN_CRON')) {
    ini_set('display_errors', '0');
} else {
    ini_set('display_errors', '1');
}    
// DATOS ADMINISTRATIVOS
defined('WEB_MASTER_MAIL') || define("WEB_MASTER_MAIL","david@mayopi.com");
// PATHS Y LINKS


// DB INFO
defined('DB_TOOL_NAME') || define("DB_TOOL_NAME","mesamenu");


if (APPLICATION_ENV == 'production' || defined('RUN_CRON')) {
    defined('PROTOCOL_TYPE') || define('PROTOCOL_TYPE', 'http://');
    defined('HOME_DIRFILE') || define('HOME_DIRFILE','/var/www/html/test.mesamenu/'); // link de inicio
    defined('BASE_URL') || define('BASE_URL', 'http://mesamenu.com');   
    defined('HOME_DIR') || define('HOME_DIR','/'); // link de inicio
    defined('BASE_HOME') || define("BASE_HOME",BASE_URL.'/');
    defined('FACEBOOK') || define("FACEBOOK",'639449806134336'); // tiempo maximo de inactividad (mins), SESS_TIME_LIMIT > 0 siempre

} else {
    defined('PROTOCOL_TYPE') || define('PROTOCOL_TYPE', 'http://');
    defined('HOME_DIRFILE') || define('HOME_DIRFILE','/'); // link de inicio
    defined('BASE_URL') || define('BASE_URL', 'http://test.perumenu.dev');
    defined('HOME_DIR') || define('HOME_DIR','/'); // link de inicio
    defined('BASE_HOME') || define("BASE_HOME",BASE_URL.HOME_DIR);
    defined('FACEBOOK') || define("FACEBOOK",'648941031851880'); // tiempo maximo de inactividad (mins), SESS_TIME_LIMIT > 0 siempre
}

defined('HOME_FS_DIR') || define('HOME_FS_DIR',$_SERVER['DOCUMENT_ROOT'].HOME_DIR); // path de inicio
defined('PAISDEFAULT_ID') || define("PAISDEFAULT_ID",5);

defined('CIUDADDEFAULT_ID') || define("CIUDADDEFAULT_ID","Lima");
// SESSION
defined('SESS_COOKIE_NAME') || define("SESS_COOKIE_NAME","ARGEN_SESSID"); // nombre de la cookie de sesion
defined('SESS_TIME_EXPIRE') || define("SESS_TIME_EXPIRE",0); // mata la session antes del tiempo predeterminado (24 mins), si es 0 no lo toma en cuenta
defined('SESS_TIME_LIMIT') || define("SESS_TIME_LIMIT",40); // tiempo maximo de inactividad (mins), SESS_TIME_LIMIT > 0 siempre


/***************************************************************************************************/
/***************************************************************************************************/
//SSOPORTE EMAIL
defined('HELP_EMAIL') || define("HELP_EMAIL","david@mayopi.com");

// load librerias //

include_once dirname(__FILE__) . '/DbMesaMenu.php';

?>