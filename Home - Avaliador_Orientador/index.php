<?php 
    
    include("../conexao.php");

    $codigo_usuario = intval($_GET['id']);

    $sql_code = "SELECT nome FROM usuario WHERE cod_usuario = '$codigo_usuario'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $dado = $sql_query->fetch_assoc();


?>

<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="style-h-AO.css"/>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Montserrat:wght@300;400;800&family=Newsreader&display=swap" rel="stylesheet">
    
    </head>
    <body> 
        <aside> 
            <div class="menu">
                <div class="upper">
                    <div class="menu-box home" id="home"><a href="index.php?id=<?php echo $codigo_usuario ?>"> 
                        <div class="home-img"> <img src="../Imagens/home-white-18dp.svg" height="60px"/> </div>
                    </a></div>
                </div>

                <div class="lower">
                    <div class="menu-box profile"><a> <img src="../Imagens/user.svg" height="40px"/> </a></div>
                    <div class="profile-box">
                        <img class="profile-box-img" src=""> 
                        
                        <h1><?php echo $dado['nome']; ?></h1>
                        <h2>Análise e Desenvolvimento de Sistemas</h2>
                    
                        <a href="../Dados do perfil/index.php?id=<?php echo $codigo_usuario?>"><div class="profile-box-data"> 
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
                    <h1>Bem vindo(a), <?php echo $dado['nome']; ?>.</h1>
                    <h2>Funcionalidades:</h2>
                    <div class="func">
                        <a href=""><div class="func-box first">
                            <img src="../Imagens/article-white-18dp.svg" height="75px">
                            <h2>Situação dos artigos</h2>
                        </div></a>

                        <a href=""><div class="func-box last">
                            <img src="../Imagens/article-white-18dp.svg" height="75px">
                            <h2>Avaliar artigo</h2>
                        </div></a>
                    </div>

                    <div class="func">
                        <a href=""><div class="func-box first">
                            <img src="../Imagens/article-white-18dp.svg" height="75px">
                            <h2>Cadastrar artigo</h2>
                        </div></a>
                        <a href=""><div class="func-box last">
                            <img src="../Imagens/article-white-18dp.svg" height="75px">
                            <h2>Editar artigo</h2>
                        </div></a> 
                    </div>
                </div>
            </div>
        </main>
        <script type="text/javascript" src="../JavaScript/script-profile.js"> </script>
    </body>
</html>