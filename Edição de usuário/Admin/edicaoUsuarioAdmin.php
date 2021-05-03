<?php

	include("../../conexao.php");
	
    /* javascript: if(confirm('Tem certeza que deseja deletar o usuário <?php echo $linha['nome']; ?> ?')) location.href='deletarUsuarioAdmin.php?usuario=<?php echo $codigo_usuario; ?>&id=<?php echo $id_usuario;?>';">
    */
    $codigo_usuario = intval($_GET['usuario']);
    $id_usuario = intval($_GET['id']);
		
	if(isset($_POST['confirma'])){
		
		//1 - Registro dos dados
		if(!isset($_SESSION))
			session_start();
		
		foreach($_POST as $chave=>$valor)
			$_SESSION[$chave] = $mysqli->real_escape_string($valor);
			
		
		//2 - Validação dos Dados
		if(strlen($_SESSION['nome'])==0)
			$erro[] = "Preencha o nome.";
		
		if(substr_count($_SESSION['email'], '@') != 1 || substr_count($_SESSION['email'], '.') < 1 || substr_count($_SESSION['email'], '.') > 2)
			$erro[] = "Preencha o email corretamente.";
		
		if(strlen($_SESSION['cpf'])==0)
			$erro[] = "Preencha o cpf.";
		
		if(strlen($_SESSION['ra'])==0)
			$erro[] = "Preencha o RA.";
		
		if(strlen($_SESSION['senha'])< 8 || strlen($_SESSION['senha']) > 32)
			$erro[] = "Preencha a senha corretamente.";
		
		if(strcmp($_SESSION['senha'], $_SESSION['senha-confirm']) != 0)
			$erro[] = "As senhas não batem.";
		
		//3 - Inserção no Banco e redirecionamento
		if(!isset($erro)){

            $sql_code = "SELECT * FROM usuario WHERE cod_usuario = '$codigo_usuario'";
            $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
            $linha2 = $sql_query->fetch_assoc();
			
            if(strcmp($_SESSION['senha'], $linha2['senha']) == 0){
                $senha = $_SESSION['senha'];
            }else{
                $senha = md5(md5($_SESSION['senha']));
            }
			
			$sql_code = "UPDATE usuario SET
                nome = '$_SESSION[nome]', 
                senha = '$senha', 
                cpf = '$_SESSION[cpf]', 
                email = '$_SESSION[email]', 
                matricula = '$_SESSION[ra]'
                WHERE cod_usuario = '$codigo_usuario'";
									
			$confirma = $mysqli->query($sql_code) or die($mysqli->error);
			
			if($confirma){
				unset($_SESSION['nome'],
					  $_SESSION['senha'],
					  $_SESSION['cpf'],
					  $_SESSION['emai'],
					  $_SESSION['ra']);
					  
					  echo"<script> location.href='../../Confirmações/alertEdicao.php?id={$id_usuario}&usuario={$codigo_usuario}'; </script>";
					  
			}
			else 
				$erro[] = $confirma;
			
		}
		
	}
	else if(isset($_POST['cancela'])){
		echo"<script> location.href='../../Confirmações/confirmEdicao.php?id={$id_usuario}&usuario={$codigo_usuario}'; </script>";
	}
    else{

        $sql_code = "SELECT * FROM usuario WHERE cod_usuario = '$codigo_usuario'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linha = $sql_query->fetch_assoc();

        if(!isset($_SESSION)){
			session_start();
        }

        $_SESSION['nome'] =  $linha['nome'];
		$_SESSION['senha'] =  $linha['senha'];
        $_SESSION['senha-confirm'] = $linha['senha'];
		$_SESSION['cpf'] =  $linha['cpf'];
		$_SESSION['email'] =  $linha['email'];
		$_SESSION['ra'] =  $linha['matricula'];
   
		
    }

?>

<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="../style-edicao.css"/>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Montserrat:wght@300;400;800&family=Newsreader&display=swap" rel="stylesheet">
        
    </head>
    <body> 
        <aside> 
            <div class="menu">
                <div class="menu-box home" id="home"><a href="../../Home - Admin/homeAdmin.php?id=<?php echo $id_usuario;?>"> 
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
                    <h1>Edição de usuário</h1>
                    <?php 
						if(isset($erro)){
						echo"<div class='erro'>";
						foreach($erro as $valor) 
							echo "$valor <br>"; 
						echo"</div>";
						}
					?>
                    <form method="POST">
                        <div class="form-box">
                            <div class="formulario">
                                <div class="form-item">
                                    <h2> Nome completo:</h2>
                                    <input type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>">
                                </div>
                                <div class="form-item">
                                    <h2> Email:</h2>
                                    <input type="text" name="email" value="<?php echo $_SESSION['email']; ?>">
                                </div>
                                <div class="form-item">
                                    <h2> CPF:</h2>
                                    <input maxlength="14" onkeypress="formatar(this,'000.000.000-00')" type="text" name="cpf" value="<?php echo $_SESSION['cpf']; ?>">
                                </div>
                                <div class="form-item">
                                    <h2> RA (Registro do aluno):</h2>
                                    <input type="text" name="ra" value="<?php echo $_SESSION['ra']; ?>">
                                </div>
                            </div>
                            <div class="formulario">
                                <div class="form-item">
                                    <h2> Senha:  <img class="i-senha" src="../../Imagens/info-white-18dp.svg" height="20px"> </h2> 
                                    <input type="password" name="senha" value="<?php echo $_SESSION['senha']; ?>">
                                    <div class="info-senha"> Sua senha deve conter pelo menos 8 caracteres e no máximo 20 caracteres.</div>
                                </div>
                                <div class="form-item">
                                    <h2> Confirme sua senha: </h2>
                                    <input type="password" name="senha-confirm" value="<?php echo $_SESSION['senha-confirm']; ?>">
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
        <script type="text/javascript" src="../../JavaScript/script-cadastro.js"> </script>
    </body>
</html>