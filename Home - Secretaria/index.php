<?php 
    
    include("../conexao.php");

    $id_usuario = intval($_GET['id']);

    $sql_code = "SELECT * FROM usuario WHERE cod_usuario = '$id_usuario'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $dado = $sql_query->fetch_assoc();

    $sql_code = "SELECT nome FROM cursos WHERE cod_cursos = '$dado[curso]'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $linha = $sql_query->fetch_assoc();

    $sql_code = "SELECT tipo FROM tipousuario WHERE cod_tipo = '$dado[tipo]'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $linha2 = $sql_query->fetch_assoc();

?>

<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="style-h-secretaria.css"/>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Montserrat:wght@300;400;800&family=Newsreader&display=swap" rel="stylesheet">
        
        
    </head>
    <body> 
        <aside> 
            <div class="menu">
                <div class="upper">
                    <div class="menu-box home" id="home"><a href="index.php?id=<?php echo $id_usuario ?>"> 
                        <div class="home-img"> <img src="../Imagens/home-white-18dp.svg" height="60px"/> </div>
                    </a></div>
                </div>

                <div class="lower">
                    <div class="menu-box profile"><a> <img src="../Imagens/user.svg" height="40px"/> </a></div>
                    <div class="profile-box">
                        <img class="profile-box-img" src="../Imagens/p-picture.jpeg"> 
                        
                        <h1><?php echo $dado['nome']; ?></h1>
                        <h2><?php if($dado['tipo']==2){echo $linha['nome'];}else{echo $linha2['tipo'];}?></h2>
                    
                        <a href="../Dados do perfil/index.php?id=<?php echo $id_usuario?>"><div class="profile-box-data"> 
                            <img src="../Imagens/article-white-18dp.svg" height="20px">
                            Dados do perfil
                        </div></a>
                    </div>
                    <div class="menu-box" id="logout"><a href="../logout.php"> <img src="../Imagens/logout-white-18dp.svg" height="40px"/> </a></div>    
                </div>
            </div>
        </aside>
        <main>
            <div class="principal">
                <div class="filler"></div>
                <div class="container">
                    <h1>Central de gerenciamento</h1>
                    <h2>Manter usuários:</h2>
                    <div class="func">
                        <a href="../Cadastro de usuário/Secretaria/index.php?id=<?php echo $id_usuario; ?>"><div class="func-box first">
                            <img src="../Imagens/article-white-18dp.svg" height="75px">
                            <h2>Cadastrar usuário</h2>
                        </div></a>

                        <a href="../Edição de usuário/Secretaria/Usuarios Cadastrados/UsuariosCadastrados.php?id=<?php echo $id_usuario; ?>"><div class="func-box last">
                            <img src="../Imagens/article-white-18dp.svg" height="75px">
                            <h2>Editar usuário</h2>
                        </div></a>
                    </div>

                    <h2>Relatórios:</h2>
                    <div class="func">
                        <a href=""><div class="func-box first">
                            <img src="../Imagens/article-white-18dp.svg" height="75px">
                            <h2>Relatório de artigos</h2>
                        </div></a>  
                    </div>
                </div>
            </div>
        </main>
        <script type="text/javascript" src="../JavaScript/script-profile.js"> </script>
    </body>
</html>