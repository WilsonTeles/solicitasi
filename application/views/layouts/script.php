<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

$('.confirma_exclusao').on('click', function(e) {
                e.preventDefault();

                var nome = $(this).data('nome');
                var id = $(this).data('id');

                $('#modal_confirmation_exclusao').data('nome', nome);
                $('#modal_confirmation_exclusao').data('id', id);
                $('#modal_confirmation_exclusao').modal('show');
            });

            $('#modal_confirmation_exclusao').on('show.bs.modal', function () {
                var nome = $(this).data('nome');
                $('#nome_exclusao').text(nome);
            });

            $('#btn_excluir').click(function(){
                var id = $('#modal_confirmation_exclusao').data('id');
                document.location.href = "<?php echo base_url(); ?>" + "coord/Ajuste/delete/"+id;
            });
            
            // ************************************************************************************* 
           $('.confirma_deferir').on('click', function(e) {
                e.preventDefault();

                var nome = $(this).data('nome');
                var id = $(this).data('id');

                $('#modal_confirmationDEFERIR').data('nome', nome);
                $('#modal_confirmationDEFERIR').data('id', id);
                $('#modal_confirmationDEFERIR').modal('show');
            });

            $('#modal_confirmationDEFERIR').on('show.bs.modal', function () {
                var nome = $(this).data('nome');
                $('#nome_deferido').text(nome);
            });
            
            $('#btn_deferir').click(function(){
                var id = $('#modal_confirmationDEFERIR').data('id');
                document.location.href = "<?php echo base_url(); ?>" + "coord/Ajuste/deferir/"+id;
            });
            
            
             // *************************************************************************************
            
            $('.confirma_indeferir').on('click', function(e) {
                e.preventDefault();

                var nome = $(this).data('nome');
                var id = $(this).data('id');

                $('#modal_confirmationINDEFERIR').data('nome', nome);
                $('#modal_confirmationINDEFERIR').data('id', id);
                $('#modal_confirmationINDEFERIR').modal('show');
            });

            $('#modal_confirmationINDEFERIR').on('show.bs.modal', function () {
                var nome = $(this).data('nome');
                $('#nome_indeferido').text(nome);
            });
            
            $('#btn_indeferir').click(function(){
                var id = $('#modal_confirmationINDEFERIR').data('id');
                document.location.href = "<?php echo base_url(); ?>" + "coord/Ajuste/indeferir/"+id;
            });


