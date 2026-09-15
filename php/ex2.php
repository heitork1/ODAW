<!-- 2- Explore em um exemplo o uso de "function",
utilize ainda alguma(s) funções do PHP para manipulação
de Strings e Arrays. -->

<?php

    // Fazendo uma função que retorna somente 
    // os valores pares de um vetor

    function parNum($numeros) {
        $resultado = [];
        
        foreach ($numeros as $num) {
            if ($num % 2 == 0 ){
                $resultado[] = $num;
            }   
        }

        return $resultado;
    }

    $vetor = [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    $resultado_final = parNum($vetor);
    echo "Vetor final: <br> " ;
    foreach ($resultado_final as $valor) {
        echo $valor . "\n";
    }

?>

