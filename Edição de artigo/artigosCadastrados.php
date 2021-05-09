<?php 
    include("../conexao.php");

    $id_usuario = intval($_GET['id']);

    $sql_code = "SELECT * FROM artigos";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $linha = $sql_query->fetch_assoc();

    if(!isset($linha)){
        header('Location:../Confirmações/artigoNaoEncontrado.php');
        die();
    }

?>

<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="styleTabelaArtigos.css"/>

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
                    <h1>Artigos Cadastrados:</h1>
                    
                    <table cellpadding=10>
                        <tr class=titulo>
                            <td>Autores</td>
                            <td>Orientador</td>
                            <td>Avaliadores</td>
                            <td>Título</td>
                            <td>Data</td>
                            <td>Status</td>
                            <td>Arquivo</td>
                            <td>Ação</td>
                        </tr>
                        <?php 
                            do{

                        ?>  
                        <tr>
                            <td><?php
                                    $exaut = explode(', ', $linha['autores']);
                                    $cont = count($exaut);
 
                                    for($i=0;$i<$cont;$i++){
                                        $sql_code1 = "SELECT nome FROM usuario WHERE matricula = '$exaut[$i]'";
                                        $sql_query1 = $mysqli->query($sql_code1) or die($mysqli->error);
                                        $nomeautor = $sql_query1->fetch_assoc();
                                        $vetorautor[$i] = $nomeautor['nome'];
                                    }

                                    foreach($vetorautor as $item1){echo "• $item1 </br>"; }
                                    unset($vetorautor);
                                ?></td>

                            <td><?php 
                                 $sql_code2 = "SELECT nome FROM usuario WHERE email = '$linha[orientador]'";
                                 $sql_query2 = $mysqli->query($sql_code2) or die($mysqli->error);
                                 $nomeorientador = $sql_query2->fetch_assoc();

                                echo $nomeorientador['nome']; 
                                ?></td>

                            <td><?php
                                    $exaval = explode(', ', $linha['avaliadores']);
                                    $cont1 = count($exaval);
 
                                 for($i=0;$i<$cont1;$i++){
                                     $sql_code3 = "SELECT nome FROM usuario WHERE email = '$exaval[$i]'";
                                     $sql_query3 = $mysqli->query($sql_code3) or die($mysqli->error);
                                     $nomeavaliador = $sql_query3->fetch_assoc();
                                     $vetoravaliador[$i] = $nomeavaliador['nome'];
                                 }

                                 foreach($vetoravaliador as $item2){echo "• $item2 </br>"; }
                                 unset($vetoravaliador);
                                ?></td>

                            <td><?php echo $linha['titulo']; ?></td>
                            <td>
                                <?php 
                                    $data = explode("-", $linha['datacadastro']);
                                    echo "$data[2]/$data[1]/$data[0]";
                                ?>
                            </td>
                            <td><?php 
                                     if($linha['statusartigo']==1){
                                         echo "Cadastrado";
                                     }
                                     else if($linha['statusartigo']==2){
                                        echo "Em avaliação";
                                    }
                                    else if($linha['statusartigo']==3){
                                        echo "Aprovado";
                                    }
                                    else if($linha['statusartigo']==4){
                                        echo "Não aprovado";
                                    }
                                    else if($linha['statusartigo']==5){
                                        echo "Publicado";
                                    }
                                ?></td>
                            <td>  <a href="../Artigos/Upload/<?php echo $linha['diretorio_artigo']?>">PDF</a> </td>
                            <td>
                                <a href="edicaoArtigo.php?artigo=<?php echo $linha['cod_artigos']; ?>&id=<?php echo $id_usuario; ?>">Editar</a>
                                <a href="../Confirmações/confirmExcluirArtigo.php?artigo=<?php echo $linha['cod_artigos']; ?>&id=<?php echo $id_usuario;?>">Excluir</a>
                            </td>
                        </tr>
                        <?php }while($linha = $sql_query->fetch_assoc());  ?>

                    </table>
               
            </div>
        </main>
    </body>
</html>