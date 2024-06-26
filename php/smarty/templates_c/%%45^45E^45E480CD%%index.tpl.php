<?php /* Smarty version 2.6.31, created on 2024-06-25 17:22:03
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
<?php echo '2.6.31'; ?>

    <?php 
    global $op;
    echo(exec("expr " . $op));
     ?>


  </body>
</html>
