<?php
    include('database.php');

    if (isset($_POST['create_usuario'])){
        $usuario = $_POST['usuario'];
        $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];

        $sql = "insert into usuario(usuario, nombres, apellidos, clave) values('$usuario', '$nombres', '$apellidos', '$clave')";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Consulta ha fallado.");
        }
        header('location: add_articulo.php');
    }
?>
<?php include("partials/header.php")?>
<body class="m-0 row vh-100 justify-content-center align-items-center">
    <div class="container p-4">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card card-body text-center">
                    <div class="mb-4">
                        <img src="images/cunori.png" alt="" width="200" height="210">
                    </div>
                    <h3>Registrarse</h3>
                    <form action="signup.php" method="POST">
                        <div class="form-group">
                            <input type="email" name="usuario" class="form-control" placeholder="Correo electrónico" autofocus required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="clave" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
                        </div>
                        <button type="submit" id="btnAgregar" class="btn btn-primary btn-block" name="create_usuario">Registrarse</button>
                    </form>
                    <div class="mt-4"><span><a href="login.php">Iniciar Sesión</a></span></div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("partials/footer.php")?>