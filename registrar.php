<?php
    session_start();
    include("db.php");

    if(isset($_POST['criar'])){
        $nome = $_POST['nome'];
        $apelido = $_POST['apelido'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $data = date("y/m/d");
        $validacao = true;

        $verificar_email = mysqli_query($conn, "SELECT email FROM USERS WHERE email = '$email'");
        $verificar_apelido = mysqli_query($conn, "SELECT apelido FROM users WHERE apelido = '$apelido' ");
        $row_email = mysqli_num_rows($verificar_email);
        $row_apelido = mysqli_num_rows($verificar_apelido);

        
        if(!$validacao){

        $query = "INSERT INTO users (`nome`, `apelido`, `senha`, `data`, `email`) VALUES ('$nome', '$apelido', '$senha', '$data', '$email')";

        $data = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if($data){
            $_SESSION['usuario'] = $email;
            setcookie("login", $email);
            header("location: principal.html");
        }else{
            echo "<div id='erro'><h3>Erro</h3></div>";
        }
    }
    };    

    if(isset($_POST['to_login'])){
        header("location: login.php");
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
<body id="registrar">
    <main class="container">

    <?php

    $estilo = 
    "background-color: rgba(230, 18, 18, 0.507);
    border-radius: 10px;
    padding: 3px;
    color: #fff;
    font-size: 1rem;
    text-align: center;";

    
    

    if(isset($_POST['criar'])){
        $nome = $_POST['nome'];
        $apelido = $_POST['apelido'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if($nome == '' || strlen($nome) <= 3){
            echo "<div class='erro' style='$estilo'><h3>Nome inválido</h3></div>";
            $validacao = false;
        } elseif($apelido == '' || strlen($apelido)<= 4){
            echo "<div class='erro' style='$estilo'><h3>Apelido inválido</h3></div>";
            $validacao = false;
        } elseif( strlen($senha < 5)){
            echo "<div class='erro' style='$estilo'><h3>Senha inválida</h3></div>";
            $validacao = false;
        } elseif($email == '' || strlen($email)<= 14){
            echo "<div class='erro' style='$estilo'><h3>Email inválido</h3></div>";
            $validacao = false;
        } elseif($row_email >= 1){
            echo "<div class='erro' style='$estilo'><h3>Email já cadastrado</h3></div>";
            $validacao = false;
        } elseif ($row_apelido >= 1){
            echo "<div class='erro' style='$estilo'><h3>Apelido já cadastrado</h3></div>";
            $validacao = false;
    }};

    ?>

    <h2>Criar conta</h2>
        <form id="form_login" method="POST">
            <div class="div-input">
                <input type="text" placeholder="Nome" name="nome">
                <div class="efeito"></div>
            </div>

            <div class="div-input">
                <input type="text" placeholder="Apelido" name="apelido">
                <div class="efeito"></div>
            </div>

            <div class="div-input">
                <input type="email" placeholder="Email" name="email">
                <div class="efeito"></div>
            </div>

            <div class="div-input">
                <input type="password" placeholder="Senha" name="senha">
                <div class="efeito"></div>
            </div>
            
            <input type="submit" value="Criar uma conta" name="criar"></input>
            <input type="submit" name="to_login" value="Fazer login"></input>
          
        </form>
        
    </main>

</body>
</html>