<!-- 4- Faça um exemplo mostrando o uso de "Cookie" 
e/ou "Session". -->

<?php
$cookie_name = "username";
$cookie_value = "Gustavo";

setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

if (isset($_COOKIE[$cookie_name])) {
    echo "Bem vindo, " . $_COOKIE[$cookie_name] . "!";
} else {
    echo "Cookie criado com sucesso, atualize a pagina.";
}
?>