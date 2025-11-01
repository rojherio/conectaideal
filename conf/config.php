<?php
header("Cache-Control: max-age=300, must-revalidate"); // CORRIGINDO O HISTORY.BACK
                                                       // DEFINIR TIMEZONE PADRÃO
date_default_timezone_set("America/Rio_Branco");
// OCULTAR OS WARNING DO PHP
// error_reporting(E_ALL ^ E_WARNING);
// ini_set("display_errors", 0 );
// DEFININDO OS DADOS DE ACESSO AO BANCO DE DADOS
define("DB", 'mysql');
define("DB_HOST", "localhost");
define("DB_NAME", "conectaidealcom_db");
define("DB_USER", "root");
define("DB_PASS", "root");
// CONFIGURACOES PADRAO DO SISTEMA
define("PORTAL_URL", 'http://localhost/conectaideal/');
define("TITULO_SISTEMA", 'Sistema de Gestão Municipal - ZATU');
define("FAVICON_SISTEMA", 'http://localhost/conectaideal/assets/images/conectaideal_favicon.png');
define("LOGO_DASHBOARD", 'http://localhost/conectaideal/assets/images/conectaideal_logo.png');
define("ASSETS_FOLDER", 'http://localhost/conectaideal/assets/');
define("CSS_FOLDER", 'http://localhost/conectaideal/assets/css/');
define("FONTS_FOLDER", 'http://localhost/conectaideal/assets/fonts/');
define("IMG_FOLDER", 'http://localhost/conectaideal/assets/images/');
define("ICONS_FOLDER", 'http://localhost/conectaideal/assets/icons/');
define("JS_FOLDER", 'http://localhost/conectaideal/assets/js/');
define("PLUGINS_FOLDER", 'http://localhost/conectaideal/assets/plugins/');
define("AVATAR_FOLDER", 'http://localhost/conectaideal/assets/avatar/');
define("PORTAL_URL_SERVIDOR", 'C:/xampp/htdocs/conectaideal/');
define("UTILS_FOLDER", 'http://localhost/conectaideal/utils/');
// CONFIGURACAO DE ENVIO DE E-MAIL
define('EMAIL_NOME', 'conectaideal');
define('EMAIL_ENDERECO', 'suporte@conectaideal.com.br');
define('EMAIL_TITULO', nl2br('ZATU - Administração - Prefeitura de Tarauacá-AC'));
define('EMAIL_DESENVOLVIMENTO', nl2br('ZATU - SISTEMA DE ATUALIZAÇÃO CADASTRAL'));
define('URL_ENDERECO', 'http://localhost');
// ADICIONAR CLASSE DE CONEXÃO
include_once ("Conexao.class.php");
?>