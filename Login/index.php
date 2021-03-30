<?php 

include("../conexao.php");

if(isset($_POST['email']) && strlen($_POST['email']) > 0){

	if(!isset($_SESSION))
		session_start();
		
	$_SESSION['email'] = $mysqli->escape_string($_POST['email']);
	$_SESSION['senha'] = md5(md5($_POST['senha']));

	
	$sql_code = "SELECT senha, email, tipo, cod_usuario FROM usuario WHERE email = '$_SESSION[email]'";
	$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
	$dado = $sql_query->fetch_assoc();
	$total = $sql_query->num_rows;
	
	if($total == 0){
		$erro[] = "Este email não pertence à nenhum usuário.";
	}
	else{
		if($dado['senha'] == $_SESSION['senha']){
		
			$_SESSION['usuario'] = $dado['cod_usuario'];
			
		}
		else{
			
			$erro[] = "Senha incorreta.";
		}
	
	}
	
	if(!isset($erro)){
        
        if($dado['tipo']==1)
		echo "<script> location.href='../Home - Admin/homeAdmin.php?id={$dado['cod_usuario']}'; </script>";

        else if($dado['tipo']==2)
		echo "<script> location.href='../Home - Autor/homeAutor.php?id={$dado['cod_usuario']}'; </script>";

        else if($dado['tipo']==3)
		echo "<script> location.href='../Home - Avaliador_Orientador/homeAvaliadorOrientador.php?id={$dado['cod_usuario']}'; </script>";
        
        else if($dado['tipo']==4)
		echo "<script> location.href='../Home - Secretaria/homeSecretaria.php?id={$dado['cod_usuario']}'; </script>";
	}

}

?>
<html>
    <head>
        <meta charset="UTF-8"/>
        
        <link rel="stylesheet" type="text/css" href="style-login.css"/>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Montserrat:wght@300;400;800&family=Newsreader&display=swap" rel="stylesheet">
        
    </head>
    <body> 
        <main>
            <aside> 
                <div class="menu">
                        <div class="menu-box" id="login"><a> <img src="../Imagens/login-white-18dp.svg" height="40px"/> </a></div>
                        <div class="menu-box" id="question"><a> <img src="../Imagens/info-white-18dp.svg" height="40px"/> </a></div>
                        <div class="login">
                            <form method="POST" action=""> 
                                <input type="text" name="email" placeholder="Email" class="input-box" value="<?php if(isset($_SESSION)){echo $_SESSION['email'];} ?>">
                                <input type="password" name="senha" placeholder="Senha" class="input-box">
                                <input class="submit" type="submit" name="enviar" value="Login"/>
								
								<?php if(isset($erro))
										foreach($erro as $msg){
											echo "<script> document.querySelector('.login').style.opacity = '1'; </script>";
                                            echo "<p>$msg</p>";
										}
								?>
                            </form>
                        </div>
                        <div class="question">
                            Este sistema está na versão: 0.0.1
                            <br><br>
                            16/02/2021
                        </div>
                </div>
            </aside>
            <div class="principal">
                <div class=container>
                    <div class="title">
                        Sistema de gerenciamento de artigos científicos
                    </div>
                    <div class="div-line"></div>
                    <div class="texto">
					
                        <p>
                            Considerando o novo modelo de trabalho de graduação (Artigo científico) adotado pela Fatec, criou-se a necessidade 
                            da instituição em um controle dos trabalhos que serão apresentados a partir desse novo método. </br></br>
                            Para facilitar a organização e oficialização de entregas e avaliações dos artigos escritos pelos alunos, este 
                            sistema foi criado. </br></br>
                            Este sistema WEB foi desenvolvido pelos seguintes alunos do curso Análise e Desenvolvimento de Sistemas: 
                            </br></br>
                            <div class="lista">
                                <ul>
                                    <li>Iago Baldani de Almeida</li>
                                    <li>Igor Santander Angelini</li>
                                    <li>Filipe Antunes</li>
                                    <li>Marcelo José Rodrigues Bolfarini</li>
                                    <li>Gustavo de Oliveira Juliano</li>
                                </ul>
                            </div>
                        </p>
                    </div>

                    <div class="div-line"></div>

                    <div class="logo-footer">
                        <img src="../Imagens/logo_fatec.png" height="75px"/>
                        <img src="../Imagens/logo-cps.png" height="75px"/>
                    </div>
                </div>
            </div>
        </main>
        <script type="text/javascript" src="../JavaScript/script-login.js"> </script>
    </body>
</html>