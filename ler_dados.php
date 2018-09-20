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
        <h1>Northwest Express </h1>
    </header>
    <?php
        date_default_timezone_set("America/Sao_Paulo");

        function verifica_campo($campo){
            return isset($_POST[$campo]) ? true : false;
        }

        function valorCampo($campo){
            if(verifica_campo($campo)){
                return $_POST[$campo];
            }
        }

        function precoOpcional($arrOpt){
            $precoOp = 0;
            
            if(gettype($arrOpt) === null){
                return 0;
            }else{    
                foreach($arrOpt as $opt){
                    if($opt === "doce de leite"){
                        $precoOp += 15.00;
                    }else if($opt === "queijo"){
                        $precoOp += 25.00;
                    }else{
                        $precoOp += 14.00;
                    }
                }

                return $precoOp;
            }
        }

        function precoFinal($passeio,$qtde,$precoOp,$tipo_vagao){
            $preco = valorPasseio($passeio);
            if($tipo_vagao == "Vagao Economico"){
                return get_preco($preco,$qtde,$precoOp);
            }else if($tipo_vagao === "Vagão Executivo"){
                return get_preco($preco,$qtde,$precoOp,200);
            }else{
                return get_preco($preco,$qtde,$precoOp,350);
            }
        }

        function get_preco($preco,$qtde,$opc,$preco_vagao = 0){
            return $preco * $qtde + $opc + $preco_vagao;
        }

        function valorPasseio($passeio){
            if($passeio === "Passeio Normal"){
                return 250;
            }else if($passeio === "Passeio Panorâmico"){
                return 350;
            }else{
                return 500;
            }
        }

        function emitir_passagem($dados_compra){
            $fp = fopen("passagem.txt","w");
            for($i = 0; $i < count($dados_compra); $i++){
                $content = "$dados_compra[$i] \n";
                fwrite($fp,$content);
            }

            fclose($fp);
        }

        $nome =  valorCampo('first-name');
        $sobrenome = valorCampo('last-name');

        $opcionais = valorCampo('optional');
        $valor_opcional = precoOpcional($opcionais);

        echo "<h2>$opcionais</h2>";


        $tipo_bilhete = valorCampo('ticket');
        $qtde = valorCampo('qtde_bilhetes');

        $data_partida = valorCampo('data-de-partida');
        $tipo_vagao = valorCampo('vagao');

        $data = date("d/m/Y H:i:s");
        $preco =  precoFinal($tipo_bilhete,$qtde,$valor_opcional,$tipo_vagao);

        $data_msg = "Data da compra: $data";
        $preco = number_format($preco,2);
        $preco_msg = "R$ $preco";

        $dados = array($nome,$tipo_bilhete,$qtde,$preco_msg,$data_partida,$data_msg);

        emitir_passagem($dados);

        foreach ($dados as $dado) {
            echo "<h2>$dado</h2>";
        }
    ?>
    
</body>
</html>