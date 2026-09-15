<!-- Crie uma página que mostre a data e hora
atual no seguinte formato:
 Hoje é 09/07/20 e agora são 16:00 -->

<?php
    date_default_timezone_set("America/Sao_Paulo");
    $data = date("d/m/Y");
    $hora = date("H:i");
    
    echo "Hoje é " , $data, " e agora são ", $hora;
?>

