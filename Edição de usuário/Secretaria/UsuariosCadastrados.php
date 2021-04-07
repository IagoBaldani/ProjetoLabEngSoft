<?php 
    include("../../conexao.php");

    $id_usuario = intval($_GET['id']);

    $sql_code = "SELECT * FROM usuario";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $linha = $sql_query->fetch_assoc();

?>

<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="../styleTabelaUsuarios.css"/>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Montserrat:wght@300;400;800&family=Newsreader&display=swap" rel="stylesheet">
        
    </head>
    <body> 
        <aside> 
            <div class="menu">
                <div class="menu-box home" id="home"><a href="javascript:history.back()"> 
                    <div class="home-img"> <img src="../../Imagens/home-white-18dp.svg" height="60px"/> </div>
                </a></div>

                <div class="menu-box" id="logout"><a href="../../logout.php"> 
                    <img src="../../Imagens/logout-white-18dp.svg" height="40px"/> 
                </a></div>    
            </div>
        </aside>
        <main>
            <div class="principal">
                <div class="filler"></div>
                <div class="container">
                    <h1>Usuários Cadastrados:</h1>
                    
                    <table border=1 cellpadding=10>
                        <tr class=titulo>
                            <td>Nome</td>
                            <td>E-mail</td>
                            <td>RA</td>
                            <td>Tipo</td>
                            <td>Ação</td>
                        </tr>
                        <?php 
                            do{
                        ?>
                        <tr>
                            <td><?php echo $linha['nome']; ?></td>
                            <td><?php echo $linha['email']; ?></td>
                            <td><?php echo $linha['matricula']; ?></td>
                            <td><?php 
                                     if($linha['tipo']==1){
                                         echo "Administrador";
                                     }
                                     else if($linha['tipo']==2){
                                        echo "Autor(Aluno)";
                                    }
                                    else if($linha['tipo']==3){
                                        echo "Avaliador";
                                    }
                                    else if($linha['tipo']==4){
                                        echo "Secretaria";
                                    }
                                ?></td>
                            <td>
                                <a href="edicaoUsuarioSecretaria.php?usuario=<?php echo $linha['cod_usuario']; ?>&id=<?php echo $id_usuario; ?>">Editar</a>
                                <a href="">Excluir</a>
                            </td>
                        </tr>
                        <?php } while($linha = $sql_query->fetch_assoc()); ?>

                    </table>
               
            </div>
        </main>
    </body>
</html>