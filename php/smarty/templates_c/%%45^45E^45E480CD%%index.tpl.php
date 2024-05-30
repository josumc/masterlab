<?php /* Smarty version 2.6.31, created on 2024-05-30 15:47:48
         compiled from index.tpl */ ?>
<html>
  <head>
    <title>Template Injection Demo</title>
  </head>
  <body>
    Hola, <?php echo $this->_tpl_vars['name']; ?>
 gracias por usa la potente calculadora "expr". <br>
    Los operadores deben estar separados por espacio.<br>
    Si usas "*" añade el carácter de escape "\*"<br>
<br><br>
    El resultado de la operación es:

    <?php 
    global $op;
       echo(exec("expr " . $op));
     ?>

  </body>
</html>
