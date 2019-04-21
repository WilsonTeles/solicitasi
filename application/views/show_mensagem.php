<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="br">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SolicitaSI</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.css') ?>" rel="stylesheet">
        <link  href="<?php echo base_url('assets/vendor/fontawesome/css/all.css') ?>" rel="stylesheet" >
        <link  href="<?php echo base_url('assets/vendor/jquery-ui/jquery-ui.css') ?>" rel="stylesheet" >
        <link  href="<?php echo base_url('assets/estilo.css') ?>" rel="stylesheet" >

    </head>

    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo base_url('Welcome') ?>">SolicitaSI - BSI - UFF</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <div class="container-fluid">
            <p></p>
            <?php if ($this->session->userdata('nome_aluno') != "") { ?>
                <div class="alert alert-secondary" role="alert">
                    Aluno: <a href="#" class="alert-link"><?php echo $this->session->userdata('nome_aluno') ?></a>
                </div>
                <p></p>
            <?php } ?>
            <div class="col-xs-12">
                <h2><?php echo $mensagem; ?></h2>
            </div>
            <div class="col-xs-12">
                <?php if ($link != '') { ?>
                <a href="<?php echo site_url($link) ?>" data-toggle="tooltip" title="Retornar" class="btn btn-warning btn-xs"><i class="fas fa-undo-alt"></i></a>
                <?php } ?>
            </div>
            <p></p>


        </div>

        <!-- /.container -->

        <!-- Footer -->
        <?php
        $this->load->view("layouts/footer");
        ?>


        <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>


    </body>

</html>
