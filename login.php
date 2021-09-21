<?php
    session_start();
    include("db.php");

    if(isset($_POST['entrar'])){
        if(empty($_POST['email']) || empty($_POST['senha'])){
            header("location: login.php");
            exit();
        }
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $verificar = mysqli_query( $conn, " SELECT * FROM users WHERE email = '$email' AND senha = '$senha'");
        $row = mysqli_num_rows($verificar);
        if($row == 1){
            $_SESSION['usuario'] = $email;
            setcookie("login", $email);
            header('location: principal.html');
            exit();
        } else{
            $_SESSION['invalido'] = true;
            header('location: login.php');
            exit();
        }

    };

    if(isset($_POST['to_registrar'])){
        header('location: registrar.php');
    };


    if(isset($_POST['to_principal'])){
        header('location: principal.html');
    };
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
<body id="login">
   
        
        <main class="container">

        <?php
            if(isset($_SESSION['invalido'])):
        ?>
            <div class="erro"
                style="background-color: rgba(230, 18, 18, 0.507);
                        border-radius: 10px;
                        padding: 3px;
                        color: #fff;
                        font-size: 1rem;
                        font-weight: 300;"
            ><h3>Email ou Senha inválidos</h3></div>
        
        <?php
            endif;
            unset($_SESSION['invalido']);
        ?>
        
            
            <h2>Login</h2> 
            
            <form id="form_login" method="POST">
           
                <div class="div-input">
                    <input type="email" name="email" placeholder="Email">
                    <div class="efeito"></div>
                </div>

                <div class="div-input">
                    <input type="password" name="senha" placeholder="Senha">
                    <div class="efeito"></div>
                </div>
            
                <input type="submit" name="entrar" value="Entrar"></input>
                <input type="submit" name="to_registrar" value="Registrar"></input>
                <input type="submit" name="to_principal" value="Entrar sem Login"></input>
            

            </form> 
        </main>
</body>
</html>