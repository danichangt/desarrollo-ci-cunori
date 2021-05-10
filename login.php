<?php

    session_start();    

    require 'database.php';

    if (!empty($_POST[':usuario']) && !empty($_POST[':clave'])) {
        $records = $conn -> prepare('select id, usuario, clave from usuario where usuario where usuario=:usuario');
        $records->bindParam(':usuario', $_POST['usuario']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message ='';

        if (count($results) > 0 && password_verify($_POST['clave'], $results['clave'])) {
            $_SESSION['user_id'] = $results['idusuario'];
            header('Location: /controlinventarios_cunori');
        } else {
            $message = 'Las credenciales de usuario no coinciden.';
        }
    }
?>

<?php include("partials/header.php")?>
    <?php include("partials/navbar.php")?>


    <?php if (!empty($message)) : ?>
        <p><?= $message ?></p>

    <?php endif; ?>

    <div class="container p-5">
        
        <div class="row">
         
            <div class="col-md-4 offset-md-4">
                
                <div class="card card-body text-center">
                    <h1>Iniciar Sesión</h1>
                    <span><a href="signup.php">Registrarse</a></span>
                    <form action="login.php" method="POST">
                        <div class="form-group">
                                <input type="email" name="usuario" class="form-control" placeholder="Correo electrónico" autofocus>
                        </div>
                        <div class="form-group">
                                <input type="password" name="clave" class="form-control" placeholder="Contraseña" autofocus>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" name="iniciar" value="Iniciar Sesión">
                    </form>

                </div>
            </div>

        </div>

    </div>

<?php include("partials/footer.php")?>