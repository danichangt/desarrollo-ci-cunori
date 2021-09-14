<?php
    require 'database.php';
    
    if (!isset($_SESSION['rol'])) {
      header('location: login.php');
    }else{
        $iduser = $_SESSION['user'];
        $query = "select u.idusuario,u.usuario, u.nombres, u.apellidos, r.crear, r.leer, r.editar, r.eliminar, r.rol from usuario u inner join rol r on 
        u.rol_idrol = r.idrol where idusuario = $iduser";
        $result = mysqli_query($conn, $query);
        $row  = mysqli_fetch_assoc($result);
    }
    
    
?>
<?php include("partials/header.php")?>
<?php include("partials/navbar.php")?>
<body>
<main class="container-fluid p-4">
    <div class="text-center mb-4">
        <h1>Cuenta de Usuario</h1>
    </div>
    <div class="row">
        <div class="col-md-4 mx-auto">
            <!-- MESSAGES -->
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message']?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['message']); } ?>
                <!-- MESSAGES -->
            <div class="card card-body">
                <label>Usuario: </label>
                <div class="form-group">
                    <input type="text" name="usuario" class="form-control" value="<?php echo $row['usuario'] ?>" readonly>
                </div>
                <label>Nombres: </label>
                <div class="form-group">
                    <input type="text" name="nombres" class="form-control" value="<?php echo $row['nombres'] ?>" readonly>
                </div>
                <label>Apellidos: </label>
                <div class="form-group">
                    <input type="text" name="apellidos" class="form-control" value="<?php echo $row['apellidos'] ?>" readonly>
                </div>
                <label>Rol: </label>
                <div class="form-group">
                    <input type="text" name="rol" class="form-control" value="<?php echo $row['rol'] ?>" readonly>
                </div>
                <div>
                <label>Privilegios: </label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="crear" id="crear" value="1" <?php if($row['crear'] ==1 ){?> checked <?php } ?> disabled>
                    <label class="form-check-label" for="crear">Crear</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="leer" id="leer" value="1" <?php if($row['leer'] ==1 ){?> checked <?php } ?> disabled>
                    <label class="form-check-label" for="leer">Leer</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="editar" id="editar" value="1" <?php if($row['editar'] ==1 ){?> checked <?php } ?> disabled>
                    <label class="form-check-label" for="editar">Editar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="eliminar" id="eliminar" value="1" <?php if($row['eliminar'] ==1 ){?> checked <?php } ?> disabled>
                    <label class="form-check-label" for="eliminar">Eliminar</label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-secondary btn-block mt-4" data-toggle="modal" data-target="#Modal_update_datos<?php echo $row['idusuario'] ?>">Editar Usuario</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-block mt-4" data-toggle="modal" data-target="#Modal_update_clave<?php echo $row['idusuario'] ?>">Cambiar Contraseña</button>
                    </div>
                    <?php include('modals/update_cuenta.php'); ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include("partials/footer.php")?>