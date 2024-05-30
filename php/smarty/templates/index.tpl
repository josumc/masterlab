<html>
  <head>
    <title>Template Injection Demo</title>
  </head>
  <body>
    Hola, { $name } gracias por usa la potente calculadora "expr". <br>
    Los operadores deben estar separados por espacio.<br>
    Si usas "*" añade el carácter de escape "\*"<br>
<br><br>
    El resultado de la operación es:

    {php}
    global $op;
       echo(exec("expr " . $op));
    {/php}

  </body>
</html>

