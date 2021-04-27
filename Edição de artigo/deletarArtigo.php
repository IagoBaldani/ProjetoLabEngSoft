<?php 

    include("../conexao.php");

    $codigo_artigo = intval($_GET['artigo']);
    $id_usuario = intval($_GET['id']);

    $sql_code = "DELETE FROM artigos WHERE cod_artigos = '$codigo_artigo'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if($sql_query)
        echo "<script> location.href='../Confirmações/alertExcluirArtigo.php?id={$id_usuario}'; </script>";
    else
        echo "<script> alert('Não foi possível deletar o usuário.'); location.href='artigosCadastrados.php?id={$id_usuario}'; </script>";

?>