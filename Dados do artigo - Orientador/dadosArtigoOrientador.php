<?php
    include("../conexao.php");

    $id_usuario = intval($_GET['id']);
    $artigo = intval($_GET['artigo']);

    $sql_code = "SELECT * FROM artigos WHERE cod_artigos = '$artigo'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $dadosartigo = $sql_query->fetch_assoc();

    $exart = explode(', ', $dadosartigo['autores']);
    $cont = count($exart);

    for($i=0;$i<$cont;$i++){
        $sql_code = "SELECT nome FROM usuario WHERE matricula = '$exart[$i]'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $nomeautor = $sql_query->fetch_assoc();
        $vetorautor[$i] = $nomeautor['nome'];
    }

    $sql_code = "SELECT statusartigo FROM statusartigo WHERE cod_status = '$dadosartigo[statusartigo]'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $statusartigo = $sql_query->fetch_assoc();

    $exaval = explode(', ', $dadosartigo['avaliadores']);
    $cont = count($exaval);

    for($i=0;$i<$cont;$i++){
        $sql_code = "SELECT nome FROM usuario WHERE email = '$exaval[$i]'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $nomeavaliador = $sql_query->fetch_assoc();
        $vetoravaliador[$i] = $nomeavaliador['nome'];
    }

    $sql_code = "SELECT nome FROM usuario WHERE email = '$dadosartigo[orientador]'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $nomeorientador = $sql_query->fetch_assoc();


?>

<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="style-dados-ao.css"/>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Montserrat:wght@300;400;800&family=Newsreader&display=swap" rel="stylesheet">
        
    </head>
    <body> 
        <aside> 
            <div class="menu">
                <div class="menu-box home" id="home"><a href="../Home - Avaliador_Orientador/homeAvaliadorOrientador.php?id=<?php echo $id_usuario ?>"> 
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
                        <p><?php echo $dadosartigo['titulo']; ?></p>
                    </div>
                    <div class="info-box">
                        <h2>Autores:<h2>
                        <p><?php foreach($vetorautor as $item){echo "$item </br>"; } ?></p>
                    </div>
                    <div class="info-box">
                        <h2>Orientador: <h2>
                        <p><?php echo $nomeorientador['nome'] ?></p>
                    </div>
                    <div class="info-box">
                        <h2>Avaliadores: <h2>
                        <p><?php foreach($vetoravaliador as $item){echo "$item </br>"; } ?></p>
                    </div>
                    <a href="../Edição de artigo/edicaoArtigo.php?artigo=<?php echo $artigo ?>&id=<?php echo $id_usuario ?>">
                        <div class="edita"> Editar artigo</div>
                    </a>
                </div>
                <div class="container2">
                    <div class="invisible"> </div>
                    <div class="info-box">
                        <h2>Status<h2>
                        <p><?php echo $statusartigo['statusartigo'] ?></p>
                    </div>
                    <div class="info-box">
                        <h2>Data de envio: <h2>
                        <?php $dataenvio = explode('-', $dadosartigo['datacadastro'])?>
                        <p><?php echo  "$dataenvio[2]/$dataenvio[1]/$dataenvio[0]";?></p>
                    </div>
                    <div class="info-box">
                        <h2>Arquivo: <h2>
                        <a href="../Artigos/Upload/<?php echo $dadosartigo['diretorio_artigo']?>"> 
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