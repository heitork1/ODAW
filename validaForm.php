<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado da Prece</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: #fdfaf5; padding: 40px; text-align: center;">

    <main class="registro" style="max-width: 600px; margin: 0 auto; text-align: left; border: 2px solid #b8860b;">
        <?php
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $erros = [];
        $sucesso = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = isset($_POST["usuario"]) ? test_input($_POST["usuario"]) : "";
            $senha = isset($_POST["senha"]) ? test_input($_POST["senha"]) : "";
            $email = isset($_POST["email"]) ? test_input($_POST["email"]) : "";
            $nascimento = isset($_POST["nascimento"]) ? test_input($_POST["nascimento"]) : "";
            $arma = isset($_POST["arma"]) ? test_input($_POST["arma"]) : "";
            $deus_escolhido = isset($_POST["deus_escolhido"]) ? test_input($_POST["deus_escolhido"]) : "";
            $mensagem = isset($_POST["mensagem"]) ? test_input($_POST["mensagem"]) : "";

            $desejos = [];
            if(!empty($_POST["desejo1"])) $desejos[] = test_input($_POST["desejo1"]);
            if(!empty($_POST["desejo2"])) $desejos[] = test_input($_POST["desejo2"]);
            if(!empty($_POST["desejo3"])) $desejos[] = test_input($_POST["desejo3"]);

            if (empty($usuario)) $erros[] = "O campo Usuário é obrigatório.";
            if (empty($senha)) $erros[] = "A Senha é obrigatória.";
            if (empty($email)) $erros[] = "O E-mail é obrigatório.";
            if (empty($nascimento)) $erros[] = "A Data de Nascimento é obrigatória.";
            if (empty($arma)) $erros[] = "Escolha sua arma de combate.";
            if (empty($deus_escolhido)) $erros[] = "Escolha o deus para a oferenda.";
            if (empty($mensagem)) $erros[] = "Escreva sua mensagem aos deuses (textarea).";

            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erros[] = "Formato de e-mail inválido.";
            }

            if (!empty($nascimento)) {
                $data_nasc = strtotime($nascimento);
                $data_hoje = strtotime("now");
                if ($data_nasc > $data_hoje) {
                    $erros[] = "A data de nascimento não pode estar no futuro.";
                }
            }

            if (empty($erros)) {
                $autenticado = false;
                $arquivo_txt = 'autenticacao.txt';

                if (!file_exists($arquivo_txt)) {
                    $hash_teste = password_hash("senha123", PASSWORD_DEFAULT);
                    file_put_contents($arquivo_txt, "admin:" . $hash_teste . "\n");
                }

                $arquivo = fopen($arquivo_txt, "r");
                if ($arquivo) {
                    while (($linha = fgets($arquivo)) !== false) {
                        $linha = trim($linha);
                        if(empty($linha)) continue;

                        list($user_txt, $hash_txt) = explode(":", $linha, 2);
                        
                        if ($usuario === $user_txt && password_verify($senha, $hash_txt)) {
                            
                            $autenticado = true;
                            break;
                        }
                    }
                    fclose($arquivo);
                }

                if (!$autenticado) {
                    $erros[] = "Credenciais inválidas! Tente outro Usuário. $usuario, $senha";
                } else {
                    $sucesso = true; 
                }
            }
        }

        if (!empty($erros)) {
            echo "<h2 style='color: #c0392b;'>A fúria dos deuses: Erros encontrados!</h2><ul>";
            foreach ($erros as $erro) {
                echo "<li class='texto'>$erro</li>";
            }
            echo "</ul><br>";
            echo "<a href='pagina3.html' class='botao' style='text-decoration:none;'>Voltar e Corrigir</a>";
        } elseif ($sucesso) {
            echo "<h2 style='color: #27ae60;'>Prece Aceita e Autenticada, Mestre $usuario!</h2>";
            echo "<h3>Resumo das informações registradas:</h3>";
            echo "<ul class='texto'>";
            echo "<li><strong>E-mail:</strong> $email</li>";
            echo "<li><strong>Data Nascimento:</strong> $nascimento</li>";
            echo "<li><strong>Arma:</strong> $arma</li>";
            echo "<li><strong>Deus Escolhido:</strong> $deus_escolhido</li>";
            
            $str_desejos = empty($desejos) ? "Nenhum" : implode(", ", $desejos);
            echo "<li><strong>Desejos:</strong> $str_desejos</li>";
            echo "<li><strong>Mensagem Oculta:</strong> $mensagem</li>";
            echo "</ul><br>";
            echo "<a href='pagina3.html' class='botao' style='text-decoration:none;'>Fazer nova prece</a>";
        } else {
            echo "<p>Acesso negado.</p>";
        }
        ?>
    </main>
</body>
</html>