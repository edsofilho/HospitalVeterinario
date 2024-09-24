<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Veterinario</title>
</head>

<body>
<img src="imgs/logo2.png" class="position-absolute start-50 top-0 translate-middle" id="imagelogo2">
    <h1 class="position-absolute start-50 translate-middle" id="h1">LOGIN SEGURO</h1>
    <div class="position-absolute top-50 start-50 translate-middle bg-success rounded mt-5 shadow-lg" id="div_1">
        <?php if (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        } ?>

        <form method="POST" action="">
            <div class="m-4">
                <label class="form-label">Email</label>
                <input type="email" name="campo_email" class="form-control">
            </div>
            <div class="m-4">
                <label class="form-label">Senha</label>
                <input type="password" name="campo_senha" class="form-control">
            </div>
            <input type="submit" class="btn btn-dark ms-4">
        </form>
        <?php
        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Captura os dados fornecidos pelo usuário
            $email_login = $_POST["campo_email"];
            $senha_login = md5($_POST["campo_senha"]);
            // Nome de usuário e senha válidos
            $email_admin = "admin@etec.com";
            $senha_admin = "21232f297a57a5a743894a0e4a801fc3";/*senha: admin*/

            // Verifica se o usuário e a senha estão corretos
            if ($email_login === $email_admin && $senha_login === $senha_admin) {
                // Redireciona para o destino
                header('Location: consulta.php');
                $_SESSION["email"] = $email_login;
                exit();
            } else {
                $error = "Usuário ou senha inválidos.";
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</html>