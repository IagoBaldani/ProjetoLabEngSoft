<?php 
    
    include("../conexao.php");

    $codigo_usuario = intval($_GET['id']);

    $sql_code = "SELECT * FROM usuario WHERE cod_usuario = '$codigo_usuario'";
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
        <link rel="stylesheet" type="text/css" href="style-dados-pf.css"/>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Montserrat:wght@300;400;800&family=Newsreader&display=swap" rel="stylesheet">
        
    </head>
    <body> 
        <aside> 
            <div class="menu">
                <div class="menu-box home" id="home"><a href="javascript:history.back()"> 
                    <div class="home-img"> <img src="../Imagens/home-white-18dp.svg" height="60px"/> </div>
                </a></div>

                <div class="menu-box" id="logout"><a href="../logout.php"> 
                    <img src="../Imagens/logout-white-18dp.svg" height="40px"/> 
                </a></div>    
            </div>
        </aside>
        <main>
            <div class="principal">
                <div class="filler"></div>
                <div class="container">
                    <h1>Dados do perfil:</h1>
                    
                    <div class="info-box">
                        <h2>Nome:</h2>
                        <p><?php echo $dado['nome'] ?></p>
                    </div>
                    <div class="info-box">
                        <h2>Email:</h2>
                        <p><?php echo $dado['email'] ?></p>
                    </div>
                    <div class="info-box">
                        <h2>RA (Registro do Aluno): </h2>
                        <p><?php echo $dado['matricula'] ?></p>
                    </div>      
                    <div class="info-box">
                         <h2><?php if($dado['tipo']==2){echo 'Curso:'; }else{echo 'Tipo de conta:';} ?></h2>
                         <p><?php if($dado['tipo']!=2){echo $linha2['tipo'];} else{echo $linha['nome'];}?></p>
                    </div>       
                </div>
                <div class="container2">
                    <div class="filler2"></div>
                    <div class="info-box">
                        <h2>Data de cadastro: </h2>
                        <p><?php 
                                $data = explode("-", $dado['datacadastro']);
                                echo "$data[2]-$data[1]-$data[0]";
                            ?></p>
                    </div>
                    <div class="info-box last">
                        <h2>Foto do Perfil:</h2>
                        <?php echo"<img class='profile-box-img' src='../Imagens/Upload/$dado[diretorio_imagem]'>"; ?>
                    </div>  
                </div>
            </div>
        </main>
    </body>
</html>