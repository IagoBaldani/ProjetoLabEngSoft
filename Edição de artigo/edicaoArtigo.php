<?php
include("../conexao.php");

$codigo_artigo = intval($_GET['artigo']);
$id_usuario = intval($_GET['id']);


$sql_code = "SELECT * FROM usuario WHERE cod_usuario = '$id_usuario'";
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
$dado = $sql_query->fetch_assoc();

	
if(isset($_POST['confirma'])){
		
 
    if(!isset($_SESSION))
        session_start();
    
    foreach($_POST as $chave=>$valor)
        $_SESSION[$chave] = $mysqli->real_escape_string($valor);

    $sql_code = "SELECT * FROM artigos WHERE cod_artigos = '$codigo_artigo'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $linha2 = $sql_query->fetch_assoc();

    if(isset($_FILES['arquivo-artigo'])){

        $arquivo = $_FILES['arquivo-artigo'];
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $arquivo_nome = md5(uniqid($arquivo['name'])).".".$extensao;
        $diretorio = "../Artigos/Upload/";

        move_uploaded_file($_FILES['arquivo-artigo']['tmp_name'], $diretorio.$arquivo_nome);

    }

    $sql_code = "UPDATE artigos SET
        autores = '$_SESSION[autores]',  
        titulo = '$_SESSION[titulo]', 
        diretorio_artigo = '$arquivo_nome',
        orientador = '$_SESSION[orientador]', 
        curso = '$_SESSION[curso]',
        avaliadores = '$_SESSION[avaliadores]'
    WHERE cod_artigos = '$codigo_artigo'";
                        
    $confirma = $mysqli->query($sql_code) or die($mysqli->error);

    if($confirma){
        unset($_SESSION['autores'],
              $_SESSION['titulo'],
              $_SESSION['orientador'],
              $_SESSION['curso'],
              $_SESSION['avaliadores']);
              
              echo"<script> location.href='../Confirmações/alertEdicaoArtigo.php?id={$id_usuario}&artigo={$codigo_artigo}'; </script>";
              
    }
    else 
        $erro[] = $confirma;

}
else if(isset($_POST['cancela'])){
    echo"<script> location.href='../Confirmações/confirmEdicaoArtigo.php?id={$id_usuario}&artigo={$codigo_artigo}'; </script>";
}
else{

    $sql_code = "SELECT * FROM artigos WHERE cod_artigos = '$codigo_artigo'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $linha = $sql_query->fetch_assoc();

    if(!isset($_SESSION)){
        session_start();
    }

    $_SESSION['autores'] =  $linha['autores'];
    $_SESSION['titulo'] =  $linha['titulo'];
    $_SESSION['orientador'] = $linha['orientador'];
    $_SESSION['curso'] =  $linha['curso'];
    $_SESSION['avaliadores'] =  $linha['avaliadores'];

    
}

?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="style-edicao-a.css"/>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Montserrat:wght@300;400;800&family=Newsreader&display=swap" rel="stylesheet">
        
    </head>
    <body> 
        <aside> 
            <div class="menu">
                <div class="menu-box home" id="home"><a href="<?php if($dado['tipo']==1){echo '../Home - Admin/homeAdmin.php?id=';echo $id_usuario;}else{echo '../Home - Secretaria/homeSecretaria.php?id=';echo $id_usuario;}?>"> 
                    <div class="home-img"> <img src="../Imagens/home-white-18dp.svg" height="60px"/> </div>
                </a></div>

                <div class="menu-box" id="logout"><a> 
                    <img src="../Imagens/logout-white-18dp.svg" height="40px"/> 
                </a></div>    
            </div>
        </aside>
        <main>
            <div class="principal">
                <div class="filler"></div>
                <div class="container">
                    <h1>Edição de artigo</h1>
                    <?php 
						if(isset($erro)){
						echo"<div class='erro'>";
						foreach($erro as $valor) 
							echo "$valor <br>"; 
						echo"</div>";
						}
					?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-box">
                            <div class="formulario">
                                <div class="form-item">
                                    <h2>Autores: <img class="info" src="../Imagens/info-white-18dp.svg" height="20px"> </h2>
                                    <input type="text" name="autores" value="<?php echo $_SESSION['autores']; ?>">
                                    <div class="info-box"> Este campo deve seguir a seguinte máscara: <br/> Nome 1, Nome 2, Nome 3...</div>
                                </div>
                                <div class="form-item">
                                    <h2> Título:</h2>
                                    <input type="text" name="titulo" value="<?php echo $_SESSION['titulo']; ?>">
                                </div>
                                <div class="form-item">
                                    <h2> Arquivo: </h2>
                                    <input type="file" name="arquivo-artigo" accept="application/pdf">
                                </div>
                            </div>
                            <div class="formulario">
                                <div class="form-item">
                                    <h2> Orientador: </h2>
                                    <input type="text" name="orientador" value="<?php echo $_SESSION['orientador']; ?>">
                                </div>
                                <div class="form-item">
                                    <h2> Curso: </h2>
                                    <select name="curso" required>
                                             <option value="2" <?php if(isset($_SESSION)){if($_SESSION['curso'] == 2) echo "selected";}?>>Agronegócio</option>
                                             <option value="3" <?php if(isset($_SESSION)){if($_SESSION['curso'] == 3) echo "selected";}?>>Analise e Desenvolvimento de Sistemas</option>
                                             <option value="4" <?php if(isset($_SESSION)){if($_SESSION['curso'] == 4) echo "selected";}?>>Jogos Digitais</option>
                                             <option value="5" <?php if(isset($_SESSION)){if($_SESSION['curso'] == 5) echo "selected";}?>>Segurança da Informação</option>
                                             <option value="6" <?php if(isset($_SESSION)){if($_SESSION['curso'] == 6) echo "selected";}?>>Ciência de Dados</option>
                                             <option value="7" <?php if(isset($_SESSION)){if($_SESSION['curso'] == 7) echo "selected";}?>>Gestão Empresarial</option>
                                    </select>
                                </div>
                                <div class="form-item">
                                    <h2> Avaliadores: <img class="info2" src="../Imagens/info-white-18dp.svg" height="20px"> </h2>
                                    <input type="text" name="avaliadores" value="<?php echo $_SESSION['avaliadores']; ?>">  
                                    <div class="info-box2"> Este campo deve seguir a seguinte máscara: <br/> Nome 1, Nome 2, Nome 3...</div>
                                </div>
                            </div>
                        </div>
                        <div class = "submit-box">
                                <input type="submit" id="confirma" name="confirma" value="Confirmar edição">
                                <input type="submit" id="cancela" name="cancela" value="Cancelar edição">
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <script type="text/javascript" src="../JavaScript/script-artigo.js"> </script>
    </body>
</html>