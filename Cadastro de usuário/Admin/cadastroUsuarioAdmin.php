<?php

	include("../../conexao.php");

    $id_usuario = intval($_GET['id']);
		
	if(isset($_POST['confirma'])){
		
		//1 - Registro dos dados
		if(!isset($_SESSION))
			session_start();
		
		foreach($_POST as $chave=>$valor)
			$_SESSION[$chave] = $mysqli->real_escape_string($valor);


        $sql_code = "SELECT email FROM usuario";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $verificaemail = $sql_query->fetch_assoc();
        
		
		//2 - Validação dos Dados
		if(strlen($_SESSION['nome'])==0)
			$erro[] = "Preencha o nome.";
		
		if(substr_count($_SESSION['email'], '@') != 1 || substr_count($_SESSION['email'], '.') < 1 || substr_count($_SESSION['email'], '.') > 2)
			$erro[] = "Preencha o email corretamente.";

        do{
            if(strcmp($_SESSION['email'], $verificaemail['email']) == 0){
                $erro[] = "Esse email já está cadastrado.";
            }

        }while($verificaemail = $sql_query->fetch_assoc());
		
		if(strlen($_SESSION['cpf'])==0)
			$erro[] = "Preencha o cpf.";
		
		if(strlen($_SESSION['ra']) == 0 && $_SESSION['tipo'] == 2)
			$erro[] = "Preencha o RA.";
		
		if(strlen($_SESSION['senha'])< 8 || strlen($_SESSION['senha']) > 20)
			$erro[] = "Preencha a senha corretamente.";
		
		if(strcmp($_SESSION['senha'], $_SESSION['senha-confirm']) != 0)
			$erro[] = "As senhas não batem.";
		
		//3 - Inserção no Banco e redirecionamento
		if(!isset($erro)){
			
			$senha = md5(md5($_SESSION['senha']));

            if($_SESSION['tipo']!=2){
                $_SESSION['curso']=1;
            }

            if(isset($_FILES['arquivo'])){

                $arquivo = $_FILES['arquivo'];
                $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
                $arquivo_nome = md5(uniqid($arquivo['name'])).".".$extensao;
                $diretorio = "../../Imagens/Upload/";

                move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$arquivo_nome);

            }

            if($_SESSION['tipo'] != 2 ){
                $_SESSION['ra'] = "XXXXXXXXXXXXX";
            }

			
			$sql_code = "INSERT INTO usuario (nome, senha, cpf, email, matricula, tipo, curso, datacadastro, diretorio_imagem)
							VALUES( '$_SESSION[nome]',
									'$senha',
									'$_SESSION[cpf]',
									'$_SESSION[email]',
									'$_SESSION[ra]',
									'$_SESSION[tipo]',
									'$_SESSION[curso]',
                                     NOW(),
                                    '$arquivo_nome'
									)";
								
									
			$confirma = $mysqli->query($sql_code) or die($mysqli->error);
			
			if($confirma){
				unset($_SESSION['nome'],
					  $_SESSION['senha'],
					  $_SESSION['cpf'],
					  $_SESSION['email'],
					  $_SESSION['ra'],
					  $_SESSION['tipo'],
					  $_SESSION['curso']);
					  
					  echo"<script> location.href='../../Confirmações/alertCadastro.php?id={$id_usuario}'; </script>";
					  
			}
			else 
				$erro[] = $confirma;
			
		}
		
	}
	else if(isset($_POST['cancela'])){
		echo"<script> location.href='../../Confirmações/confirmCadastro.php?id={$id_usuario}'; </script>";
	}

?>

<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="../style-cadastro.css"/>

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
                    <h1>Cadastro de usuário</h1>
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
                                    <h2> Nome completo:</h2>
                                    <input type="text" name="nome" value="<?php if(isset($_SESSION)){echo $_SESSION['nome'];} ?>">
                                </div>
                                <div class="form-item">
                                    <h2> Email:</h2>
                                    <input type="text" name="email" value="<?php if(isset($_SESSION)){echo $_SESSION['email'];} ?>">
                                </div>
                                <div class="form-item">
                                    <h2> CPF:</h2>
                                    <input maxlength="14" onkeypress="formatar(this,'000.000.000-00')" type="text" name="cpf" value="<?php if(isset($_SESSION)){echo $_SESSION['cpf'];} ?>">
                                </div>
                                <div id="ra" class="form-item">
                                    <h2> RA (Registro do aluno):</h2>
                                    <input maxlength="13" type="text" name="ra" value="<?php if(isset($_SESSION)){echo $_SESSION['ra'];} ?>">
                                </div>
                                <div class="form-item">
                                    <h2> Imagem do perfil:</h2>
                                    <input type="file" name="arquivo">
                                </div>
                            </div>
                            <div class="formulario">
                                <div class="form-item">
                                    <h2> Senha: <img class="i-senha" src="../../Imagens/info-white-18dp.svg" height="20px"> </h2>
                                    <input type="text" name="senha">
                                    <div class="info-senha"> Sua senha deve conter pelo menos 8 caracteres e no máximo 20 caracteres.</div>
                                </div>
                                <div class="form-item">
                                    <h2> Confirme sua senha: </h2>
                                    <input type="text" name="senha-confirm">
                                </div>
                                <div id="type" class="form-item">
                                    <h2> Tipo: </h2>
                                    <select name="tipo">
                                        <option id="1t" value="2" <?php if(isset($_SESSION)){if($_SESSION['tipo'] == 2) echo "selected";} ?>>Autor</option>
                                        <option id="2t" value="3" <?php if(isset($_SESSION)){if($_SESSION['tipo'] == 3) echo "selected";} ?>>Avaliador/Orientador</option>
                                        <option id="3t" value="4" <?php if(isset($_SESSION)){if($_SESSION['tipo'] == 4) echo "selected";} ?>>Secretaria</option>
                                        <option id="4t" value="1" <?php if(isset($_SESSION)){if($_SESSION['tipo'] == 1) echo "selected";} ?>>Admin</option>
                                    </select>
                                </div>
								<div id="curso" class="form-item">
                                        <h2> Curso: </h2>
                                        <select name="curso" required>
                                             <option value="2" <?php if(isset($_SESSION)){if($_SESSION['curso'] == 2) echo "selected";} ?>>Agronegócio</option>
                                             <option value="3" <?php if(isset($_SESSION)){if($_SESSION['curso'] == 3) echo "selected";} ?>>Analise e Desenvolvimento de Sistemas</option>
                                             <option value="4" <?php if(isset($_SESSION)){if($_SESSION['curso'] == 4) echo "selected";} ?>>Jogos Digitais</option>
                                             <option value="5" <?php if(isset($_SESSION)){if($_SESSION['curso'] == 5) echo "selected";} ?>>Segurança da Informação</option>
                                             <option value="6" <?php if(isset($_SESSION)){if($_SESSION['curso'] == 6) echo "selected";} ?>>Ciência de Dados</option>
                                             <option value="7" <?php if(isset($_SESSION)){if($_SESSION['curso'] == 7) echo "selected";} ?>>Gestão Empresarial</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class = "submit-box">
                            <input type="submit" id="confirma" name="confirma" value="Confirmar cadastro">
                            <input type="submit" id="cancela" name="cancela" value="Cancelar cadastro">
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <script type="text/javascript" src="../../JavaScript/script-cadastro.js"> </script>
    </body>
</html>