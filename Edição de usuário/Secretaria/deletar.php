<?php 

    include("../../conexao.php");

    $codigo_usuario = intval($_GET['usuario']);

    $sql_code = "DELETE FROM usuario WHERE cod_usuario = '$codigo_usuario'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if($sql_query)
        echo "<script> alert('O usuário foi deletado com sucesso.'); location.href='../../Home - Secretaria/index.html'; </script>";
    else
        echo "<script> alert('Não foi possível deletar o usuário.'); location.href='../../Home - Secretaria/index.html'; </script>";

?>