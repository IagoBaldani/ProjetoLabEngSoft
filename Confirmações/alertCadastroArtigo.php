<?php
    include("../conexao.php");

    $id_usuario = intval($_GET['id']);

    $sql_code = "SELECT * FROM usuario WHERE cod_usuario = '$id_usuario'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $dado = $sql_query->fetch_assoc();

?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="style-confirmacoes.css"/>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Montserrat:wght@300;400;800&family=Newsreader&display=swap" rel="stylesheet">
        
    </head>
    <body> 
        <main>
            <div class="container">
                <img src="../Imagens/check_circle_outline_white_36dp.svg"/>
                <h1> O artigo foi cadastrado com sucesso! </h1>
                <a class="a0" href="<?php if($dado['tipo']==1){echo '../Home - Admin/homeAdmin.php?id=';echo $id_usuario;}else{echo '../Home - Secretaria/homeSecretaria.php?id=';echo $id_usuario;} ?>" >Continuar</a>
            </div>
        </main>
    </body>
</html>