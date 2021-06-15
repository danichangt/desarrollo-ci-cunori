<?php include('database.php');?>

<?php include("partials/header.php")?>

<?php include("partials/navbar.php")?>


    <main class="container-fluid p-4">
        <div class="row">
            <div class="col-md-3 mx-auto">
            <!-- MESSAGES -->
            <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php session_unset(); } ?>
            <!-- MESSAGES -->
                <div class="card card-body">
                    <h1 class="text-center">Empleados</h1>
                    <form action="control/create_empleado.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="dpi" class="form-control" placeholder="DPI" required autofocus>
                        </div>
                        <div class="form-group">
                            <input type="text" name="codigo" class="form-control" placeholder="Código de empleado" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
                        </div>
                        <label for="areaemp_idarea">Área:</label>
                        <div class="input-group mb-1">
                            <select class="custom-select" id="areaemp_idarea" name="areaemp_idarea">
                            <?php

                                $query = "select * from areaemp order by descripcion asc";
                                $result_area = mysqli_query($conn, $query);

                                while($row = mysqli_fetch_assoc($result_area)){?>
                                <option value="<?php echo $row['idarea']?>"><?php echo $row['descripcion']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="text-center mb-3"><span><a href="areaemp_vw.php">Nueva área</a></span></div>
                        <input type="submit" class="btn btn-primary btn-block" name="create_empleado" value="Agregar">
                    </form>
                </div>
            </div>
            <div class="col-md-8 mx-auto">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>DPI</th>
                            <th>Código de empleado</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Área</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "select idempleado, dpi, codigo, nombres, apellidos, a.descripcion from empleado inner join areaemp a on a.idarea = areaemp_idarea order by nombres asc";
                            $result_empleado = mysqli_query($conn, $query);

                            while($row = mysqli_fetch_assoc($result_empleado)){?>

                                <tr>
                                    <td><?php echo $row['dpi']; ?></td>
                                    <td><?php echo $row['codigo']; ?></td>
                                    <td><?php echo $row['nombres']; ?></td>
                                    <td><?php echo $row['apellidos']; ?></td>
                                    <td><?php echo $row['descripcion']; ?></td>
                                    <td>
                                        <a href="control/update_empleado.php?idempleado=<?php echo $row['idempleado']?>"class="btn btn-secondary"><i class="fas fa-edit"></i>Editar</a>
                                    </td>
                                </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

<?php include("partials/footer.php")?>