<!-- 3 - Criar um contador de visitas (sugestão - 
usar um arquivo txt):
"Esta página foi visitada X vezes". -->

<?php
$arquivo = "arquivo.txt";

$visitas = (int) file_get_contents($arquivo);

$visitas++;

file_put_contents($arquivo, $visitas);

echo "Essa página foi visitada $visitas vezes.";

?>