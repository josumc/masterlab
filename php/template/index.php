<?php
define('SMARTY_DIR', '/usr/local/lib/php/Smarty/');
require_once(SMARTY_DIR . 'Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir='/var/www/html/smarty/templates';
$smarty->compile_dir='/var/www/html/smarty/templates_c';
$smarty->cache_dir='/var/www/html/smarty/cache';
$smarty->config_dir='/var/www/html/smarty/configs';

?>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
            $op = $_POST['op'];
            @$smarty->assign('name', $name);
            @$smarty->assign('op', $op);
            @$smarty->display('index.tpl');
        } else {
            echo "<p>Error: No se recibieron los datos del formulario.</p>";
        }
    } else {
        echo '<html>
Gracias por usa la potente calculadora "expr". <br>
    Los operadores deben estar separados por espacio.<br>
    Si usas "*" añade el carácter de escape "\*"<br><br>
                  <body>
                    <form action="" method="POST">
                      Pon tu nombre: <input type="text" name="name"><br>
                      Operación a realizar: <input type="text" name="op"><br>
                      <input type="submit">
                    </form>
                  </body>
                </html>';
    }
?>
