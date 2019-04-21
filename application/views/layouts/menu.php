<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url('Welcome') ?>">SolicitaSI - BSI - UFF</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <?php if ($this->session->userdata('status') == 'admin') { ?> 

                        <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('coord/logout') ?>">Classroom</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('coord/logout') ?>">Logout</a>
                    </li>
                <?php } else { ?>     


                    <?php if ($this->session->userdata('status') == 'formado') { ?> 
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('aluno/logout') ?>">Logout</a>
                        </li>
                    <?php } else { ?>

                        <?php
                        if ($this->session->userdata('status') == 'aluno') {

                            if ($this->session->userdata('senha_alterada') == 'N') {
                                ?>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('aluno/Aluno') ?>">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('where_isclass/Home') ?>">My Classroom</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('aluno/Ajuste_plano_estudo') ?>">Ajuste Plano de Estudo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('colegiado/Colegiado') ?>">Solicitação ao Colegiado</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('ac_solicitada/Ac_solicitada') ?>">AC</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('aluno_estagio/Estagio') ?>">Estágio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('aluno_processo_dispensa/Processo_dispensa') ?>">Dispensa de Disciplinas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('aluno_projeto/Projeto_controle') ?>">Projeto de Aplicação II</a>
                                </li>
                            <?php } ?>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('aluno/logout') ?>">Logout</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo base_url('aluno/Aluno') ?>"><i class="far fa-user"></i> <?php echo substr($this->session->userdata('nome'), 0, 10) ?> </a>
                            </li>

                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link nav-item" href="<?php echo base_url('aluno/Login') ?>">Login</a>
                            </li>
                            <?php
                        }
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

