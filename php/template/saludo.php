<?php
define('SMARTY_DIR', '/usr/local/lib/php/Smarty/');
require_once(SMARTY_DIR . 'Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir='/var/www/html/smarty/templates';
$smarty->compile_dir='/var/www/html/smarty/templates_c';
$smarty->cache_dir='/var/www/html/smarty/cache';
$smarty->config_dir='/var/www/html/smarty/configs';

$saludo = $_GET['secreto'];
@$smarty->assign("secreto", base64_decode($saludo));
@$smarty->display("secreto.tpl");
?>

