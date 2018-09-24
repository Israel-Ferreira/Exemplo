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
            
            if(gettype($arrOpt) === null ){
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
        $nome_completo = "$nome $sobrenome";

        $opcionais = valorCampo('optional');
        $valor_opcional = precoOpcional($opcionais);

        $tipo_bilhete = valorCampo('ticket');
        $qtde = valorCampo('qtde_bilhetes');

        $data_partida = date("d/m/Y",strtotime(valorCampo('data-de-partida'),2));
        $tipo_vagao = valorCampo('vagao');

        $data = "Data da compra: ". date("d/m/Y");
        $preco =  "R$ ".number_format(precoFinal($tipo_bilhete,$qtde,$valor_opcional,$tipo_vagao),2);

        $dados = array($nome_completo,$tipo_bilhete,$tipo_vagao,$qtde,$preco,$data_partida,$data);

        emitir_passagem($dados);
    ?>
    <div class="result">
        <?php
            $time_str = strtotime($data_partida);
            echo date("d/m/Y",$time_str);
            foreach ($dados as $dado) {
                echo "<h2>$dado</h2>";
            }
        ?>
    </div>
    
</body>
</html>