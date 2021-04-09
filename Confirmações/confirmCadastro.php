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
                <img src="../Imagens/information.svg"/>
                <h1> Deseja mesmo cancelar o cadastro?</h1>
                <div class="submit-box">

                         <a class="a1" href="<?php if($dado['tipo']==1){echo '../Home - Admin/homeAdmin.php?id=';echo $id_usuario;}else{echo '../Home - Secretaria/homeSecretaria.php?id=';echo $id_usuario;} ?>" >OK</a>
                         <a class="a2" href="<?php if($dado['tipo']==1){echo '../Cadastro de usuário/Admin/cadastroUsuarioAdmin.php?id=';echo $id_usuario;}else{echo '../Cadastro de usuário/Secretaria/cadastroUsuarioSecretaria.php?id=';echo $id_usuario;} ?>" >Cancelar</a>
                    
                </div>
            </div>
        </main>
    </body>
</html>