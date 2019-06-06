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
        <link  href="<?php echo base_url('assets/typeaheadjs.css') ?>" rel="stylesheet" >
        <link  href="<?php echo base_url('assets/estilo.css') ?>" rel="stylesheet" >
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
	    <link rel="stylesheet" href="<?php echo base_url('assets/css/home.css') ?>">

        <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>assets/vendor/typeahead/typeahead.js"></script>

    </head>
    <body>

        <div class="container-fluid">

            <!-- Navigation -->
            <?php
            $this->load->view("layouts/menu");
            ?>
            <p></p>

            <?php
            if (isset($breadcrumb) && is_array($breadcrumb) && count($breadcrumb) > 0) {


                if ($this->session->userdata('status') == "admin") {
                    $home = "coord/Administrador";
                } else {
                    $home = "aluno/Aluno";
                }
                ?>
                <ol class="breadcrumb breadcrumb-right-arrow">
                    <li data-toggle="tooltip" title="Retonar para página inicial" class="breadcrumb-item"><a href="<?php echo site_url($home) ?>"><i class="fa fa-fw fa-home"></i></a></li>
                    <?php
                    $ultimovalor = end($breadcrumb);

                    foreach ($breadcrumb as $key => $value) {
                        if ($value != '') {
                            ?>          
                            <?php if ($value == $ultimovalor) { ?>
                                <li data-toggle="tooltip" title="Voce está em <?php echo $key; ?>" class="breadcrumb-item active"><?php echo $key; ?></li>
                            <?php } else { ?>
                                <li data-toggle="tooltip" title="Retornar para <?php echo $key; ?>" class="breadcrumb-item"><a href="<?php echo site_url($value) ?>"><?php echo $key; ?></a></li>
                                <?php
                            }
                        }
                        ?>
                    <?php } ?>
                </ol>
            <?php } ?>


        </div>
        <!-- Page Content -->
        <div class="container-fluid">
            <?php
            if ($this->session->userdata('status') == "admin") {

                if ($this->session->userdata('id') != 0) {
                    ?>
                    <div class="row">
                        <div class="card ml-4 shadow p-3 mb-3 bg-white rounded" style="width: 12rem;">
                            <img id="IMAGE_ID" class="card-img-top" src="<?php echo $this->session->userdata('foto')."?time=".time() ?>" alt="<?php echo $this->session->userdata('nome_aluno'); ?>">
                        </div>

                        <div class="col-8">
                            <div class="alert alert-secondary" role="alert">
                                <h2 class="alert-link"><?php echo $this->session->userdata('nome_aluno'); ?></h2>
                            </div>
                            <div class="alert alert-secondary" role="alert">
                                <a href="#" class="alert-link"><?php echo $this->session->userdata('matricula_aluno'); ?></a>
                            </div>
                            <div class="alert alert-secondary" role="alert">
                                <a href="#" class="alert-link"><?php echo $this->session->userdata('email_aluno'); ?></a>
                            </div>
                        </div>

                    </div>


                    <p></p>
                <?php } ?>
                <?php
            }
            echo "<h1> $Título_da_pagina </h1><br>";
            if (isset($_view) && $_view)
                $this->load->view($_view);
            ?>

        </div>
        <!-- /.container -->

        <!-- Footer -->
        <?php
        $this->load->view("layouts/footer");
        ?>

        <?php
        if (isset($_modal) && $_modal)
            $this->load->view($_modal);
        ?>

        <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/vendor/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.mask.min.js"></script>
        <script type="application/javascript" src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
	    <script type="application/javascript" src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
	    <script type="application/javascript" src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>

        <?php if (isset($_script) && $_script) { ?>
            <script>
                $(document).ready(function () {
                    <?php $this->load->view($_script); ?>
                });
            </script>   
        <?php } ?>

    </body>

</html>

