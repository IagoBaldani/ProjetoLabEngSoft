<?php 

    include("../../conexao.php");

    $codigo_usuario = intval($_GET['usuario']);
    $id_usuario = intval($_GET['id']);

    $sql_code = "DELETE FROM usuario WHERE cod_usuario = '$codigo_usuario'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if($sql_query)
        echo "<script> location.href='../../Confirmações/alertExcluir.php?id={$id_usuario}'; </script>";
    else
        echo "<script> alert('Não foi possível deletar o usuário.'); location.href='../../Home - Secretaria/homeSecretaria.php?id={$id_usuario}'; </script>";

?>