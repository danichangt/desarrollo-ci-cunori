<?php require 'database.php';?>
<?php include("partials/header.php")?>
    <body class="m-0 row vh-100 justify-content-center align-items-center">
        <div class="container p-4">
            <div class="row">
                <div class="col-md-5 mx-auto">
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
                    <div class="card card-body text-center">
                        <div class="mb-4">
                            <img src="images/cunori.png" alt="" width="200" height="210">
                        </div>
                        <form id="form" action="control/recuperar_clave.php" method="POST">
                            <div class="form-group">
                                    <input type="email" name="usuario" class="form-control" placeholder="Correo electrónico" required autofocus>
                            </div>
                            <button type="submit" id="btnAgregar" class="btn btn-primary btn-block" name="enviar_correo">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php include("partials/footer.php")?>
<script> 
    $(document).ready(function() {
        $('#btnAgregar').click(function() {
            $(this).prop("disabled", true);
            $(this).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $('#form').submit();
        });
    });
</script>