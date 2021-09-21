<?php
    include("db.php");
    session_start();
    if(!$_SESSION['usuario']){
        header('location: login.php');
        exit();
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        header("location: ./");
    }
    
    $pubs = mysqli_query($conn, "SELECT * FROM comentarios WHERE post='$id'");
    $cookie_email = $_COOKIE['login'];


    if(isset($_POST['publish'])){

        $texto = $_POST['texto'];
        $hoje = date("Y-m-d");

        if ($texto == "") {
            echo "<h3>Escreva alguma mensagem antes de comentar</h3>";
        }else{
            $query = "INSERT INTO comentarios (user,texto,post,data) VALUES ('$cookie_email','$texto','$id','$hoje')";
            $data = mysqli_query($conn, $query) or die();
            if ($data) {
                header("location: comentarios.php?id=".$id);
            }else{
                echo "Ocorreu um erro";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina login</title>
</head>
<body>
    <div id="publicar">
		<form method="POST" enctype="multipart/form-data">
			<textarea placeholder="Escreve um comentario" name="texto"></textarea>
			<input type="submit" value="Comentar" name="publish" />
		</form>
	</div>

    <?php

        while($pub = mysqli_fetch_assoc($pubs)){
            $user = $pub['user'];
            $teste = mysqli_query($conn, "SELECT * FROM users WHERE email='$user'");
            $ordena = mysqli_fetch_assoc($teste);
            $nome = $ordena['nome']." - ".$ordena['apelido'];
            echo '<div class="pub" id='.$id.'>
					<p>'.$nome.'</p> <p>'.$pub['data'].'</p>
					<span>'.$pub['texto'].'</span>
				  </div>';

        }
    ?>

    <h2><a href="logout.php">Sair</a></h2>
</body>
</html>