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
        date_default_timezone_set("America/Sao_Paulo");
        function verifica_campo($campo){
            return isset($_POST[$campo]) ? true : false;
        }

        if(verifica_campo('first-name') && verifica_campo('last-name')){
            $nome =  $_POST['first-name'];
            $sobrenome = $_POST['last-name'];
        }

        if(verifica_campo('ticket')){
            $tipo_bilhete = $_POST['ticket'];
        }

        if(verifica_campo('qtde_bilhetes')){
            $qtde = $_POST['qtde_bilhetes'];
        }

        if(verifica_campo('data-de-partida')){
            $data_partida = $_POST['data-de-partida'];
        }

        if(verifica_campo('seguro')){
            $seguro = $_POST['seguro'];
        }

        function get_volume($preco,$qtde){
            return $preco * $qtde;
        }

        function get_valor($passeio, $qtde){
            if($passeio === "Passeio Normal"){
                return get_volume(250,$qtde);
            }else if($passeio === "Passeio Panorâmico"){
                return get_volume(350,$qtde);
            }else{
                return get_volume(500,$qtde);
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

        
        $data = date("d/m/Y H:i:s");
        $preco =  get_valor($tipo_bilhete,$qtde);

        $data_msg = "Data da compra: $data";
        $data_prt = "Data de Partida: $data_partida";

        $dados = array($nome, $tipo_bilhete,$qtde,$preco,$data_msg,$data_prt);
        emitir_passagem($dados);


        foreach ($dados as $dado) {
            echo "<h2>$dado</h2>";
        }
        
    ?>
    
</body>
</html>