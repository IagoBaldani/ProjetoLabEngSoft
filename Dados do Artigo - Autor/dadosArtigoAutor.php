<?php 
    
    include("../conexao.php");

    $id_usuario = intval($_GET['id']);

    $sql_code = "SELECT * FROM usuario WHERE cod_usuario = '$id_usuario'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $dado = $sql_query->fetch_assoc();

    $sql_code = "SELECT autores FROM artigos ";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $artigos = $sql_query->fetch_assoc();

    do{
        $exart = explode(', ', $artigos['autores']);

        if((strcmp($dado['nome'], $exart[0]) == 0) || (strcmp($dado['nome'], $exart[1]) == 0) || (strcmp($dado['nome'], $exart[2]) == 0)){
            $imart = implode($exart, ', '); 
        }

    }while($artigos = $sql_query->fetch_assoc());

    $sql_code = "SELECT * FROM artigos WHERE autores = '$imart'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $dadosartigos = $sql_query->fetch_assoc();

    
    $sql_code = "SELECT statusartigo FROM statusartigo WHERE cod_status = '$dadosartigos[statusartigo]'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $statusartigo = $sql_query->fetch_assoc();


?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="style-dados-aa.css"/>

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
                    <h1>Dados do artigo:</h1>
                    
                    <div class="info-box">
                        <h2>Título: <h2>
                        <p><?php echo $dadosartigos['titulo'] ?></p>
                    </div>
                    <div class="info-box">
                        <h2>Autores:<h2>
                        <p><?php echo $dadosartigos['autores'] ?></p>
                    </div>
                    <div class="info-box">
                        <h2>Orientador: <h2>
                        <p><?php echo $dadosartigos['orientador'] ?></p>
                    </div>
                    <div class="info-box">
                        <h2>Avaliadores: <h2>
                        <p><?php echo $dadosartigos['avaliadores'] ?></p>
                    </div>
                </div>
                <div class="container2">
                    <div class="invisible"> </div>
                    <div class="info-box">
                        <h2>Status<h2>
                        <p><?php echo $statusartigo['statusartigo'] ?></p>
                    </div>
                    <div class="info-box">
                        <h2>Data de envio: <h2>
                        <?php $dataenvio = explode('-', $dadosartigos['datacadastro'])?>
                        <p><?php echo  "$dataenvio[2]-$dataenvio[1]-$dataenvio[0]";?></p>
                    </div>
                    <div class="info-box">
                        <h2>Arquivo: <h2>
                        <a href="../Artigos/Upload/<?php echo $dadosartigos['diretorio_artigo']?>"> 
                            <div class="download"> Arquivo.pdf </div>
                        </a>
                    </div>
                    <div class="info-box">
                        <h2>Nota: <h2>
                        <p>---</p>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>