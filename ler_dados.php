<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <title>Obrigado - volte sempre</title>
</head>
<body>
    <header>
        <h1>Expresso </h1>
    </header>
    <?php
        function verifica_campo($campo){
            return isset($_POST[$campo]) ? true : false;
        }


        if(verifica_campo('first-name') && verifica_campo('last-name')){
            $nome =  $_POST['first-name'];
            $sobrenome = $_POST['last-name'];
        }

        if(verifica_campo('ticket')){
            $bilhete = $_POST['ticket'];
        }

        if(verifica_campo('qtde_bilhetes')){
            $qtde = $_POST['qtde_bilhetes'];
        }

        function emitir_passagem($array_data){
            $arquivo = "passagem.txt";
            $fp = fopen($arquivo,"w");

            for($i = 0; $i < count($array_data);$i++){
                fwrite($fp,$array_data[$i]);
            }

            fclose($fp); 
        }
        


        echo "<h2>$nome $sobrenome</h2>";
        echo "<h2>$bilhete</h2>";
        echo "<h2>$qtde</h2>";

        $dados = array($nome, $bilhete, $qtde);

        emitir_passagem($dados);

    ?>
    
</body>
</html>