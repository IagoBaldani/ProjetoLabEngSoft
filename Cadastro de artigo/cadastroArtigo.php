<?php 

include("../conexao.php");

$id_usuario = intval($_GET['id']);

if(isset($_POST['confirma'])){

    if(!isset($_SESSION))
        session_start();

    foreach($_POST as $chave=>$valor)
	    $_SESSION[$chave] = $mysqli->real_escape_string($valor);

    if(isset($_FILES['arquivo-artigo'])){

        $arquivo = $_FILES['arquivo-artigo'];
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $arquivo_nome = md5(uniqid($arquivo['name'])).".".$extensao;
        $diretorio = "../Artigos/Upload/";

        move_uploaded_file($_FILES['arquivo-artigo']['tmp_name'], $diretorio.$arquivo_nome);

    }
    $status = 1;
    
    $sql_code = "INSERT INTO artigos (autores, orientador, avaliadores, statusartigo, titulo, curso, diretorio_artigo, datacadastro)
    VALUES( '$_SESSION[autores]',
            '$_SESSION[orientador]',
            '$_SESSION[avaliadores]',
            '$status',
            '$_SESSION[titulo]',
            '$_SESSION[curso]',
            '$arquivo_nome',
            NOW()
            )";
        
            
    $confirma = $mysqli->query($sql_code) or die($mysqli->error);

    if($confirma){
        unset($_SESSION['autores'],
              $_SESSION['orientador'],
              $_SESSION['avaliadores'],
              $_SESSION['titulo'],
              $_SESSION['curso']);
              
              echo"<script> location.href='../Confirmações/alertCadastroArtigo.php?id={$id_usuario}'; </script>";
              
    }
    else 
        $erro[] = $confirma;

}
?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="style-cadastro-a.css"/>

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
                    <h1>Cadastro de artigo</h1>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-box">
                            <div class="formulario">
                                <div class="form-item">
                                    <h2>RA dos Autores: <img class="info" src="../Imagens/info-white-18dp.svg" height="20px"> </h2>
                                    <input type="text" name="autores">
                                    <div class="info-box"> Este campo deve seguir a seguinte máscara: <br/> RA 1, RA 2, RA 3...</div>
                                </div>
                                <div class="form-item">
                                    <h2> Título:</h2>
                                    <input type="text" name="titulo">
                                </div>
                                <div class="form-item">
                                    <h2> Arquivo: </h2>
                                    <input type="file" name="arquivo-artigo" accept="application/pdf">
                                </div>
                            </div>
                            <div class="formulario">
                                <div class="form-item">
                                    <h2> Orientador: </h2>
                                    <input type="text" name="orientador">
                                </div>
                                <div class="form-item">
                                    <h2> Curso: </h2>
                                    <select name="curso" required>
                                             <option value="2" >Agronegócio</option>
                                             <option value="3" >Analise e Desenvolvimento de Sistemas</option>
                                             <option value="4" >Jogos Digitais</option>
                                             <option value="5" >Segurança da Informação</option>
                                             <option value="6" >Ciência de Dados</option>
                                             <option value="7" >Gestão Empresarial</option>
                                    </select>
                                </div>
                                <div class="form-item">
                                    <h2> Avaliadores: <img class="info2" src="../Imagens/info-white-18dp.svg" height="20px"> </h2>
                                    <input type="text" name="avaliadores">
                                    <div class="info-box2"> Este campo deve seguir a seguinte máscara: <br/> Nome 1, Nome 2, Nome 3...</div>
                                </div>
                            </div>
                        </div>
                        <div class = "submit-box">
                            <input type="submit" name="confirma" value="Confirmar cadastro">
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <script type="text/javascript" src="../JavaScript/script-artigo.js"> </script>
    </body>
</html>