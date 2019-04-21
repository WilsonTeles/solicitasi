


<div class="row">
    <div class="col-4">
        <div class="card ml-4 shadow p-3 mb-3 bg-white rounded" style="width: 12rem;">
            <img class="card-img-top" src="<?php echo base_url($this->session->userdata('foto'))."?time=".time() ?>" alt="Card image cap">
            <div class="card-body">
                <a href="<?php echo base_url('aluno\Aluno\trocar_foto') ?>" data-toggle="tooltip" title="Coloque a sua foto" class="btn btn-light">Upload Foto</a>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card  shadow  bg-white rounded" >
            <div class="card-body">
                <h5 class="card-title"><?php echo mb_strtoupper($this->session->userdata('nome')) ?></h5>

                <table class="table  table-borderless">
                    <tr class="d-flex">
                        <td class="col-2"><span class="font-weight-bold float-right">Matrícula: </span></td>
                        <td><?php echo $matricula ?></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-2"><span class="font-weight-bold float-right">CPF: </span></td>
                        <td><?php echo $cpf ?></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-2"><span class="font-weight-bold float-right">Email: </span></td>
                        <td><?php echo $email ?></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-2"><span class="font-weight-bold float-right">Endereço:</span></td>
                        <td><?php echo $endereco ?></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-2"><span class="font-weight-bold float-right">Cidade:</span></td>
                        <td><?php echo $cidade ?></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-2"><span class="font-weight-bold float-right">Bairro:</span></td>
                        <td><?php echo $bairro ?></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-2"><span class="font-weight-bold float-right">Estado/Cep:</span></td>
                        <td><?php echo $estado . " / " . $cep ?></td>
                    </tr>
                </table>
                <hr>
                <a href="<?php echo base_url('aluno/Aluno/edit') ?>" data-toggle="tooltip" title="Alterar seus dados pessoais" class="btn btn-light">Alterar Dados</a>
                <a href="<?php echo base_url('aluno/Aluno/trocar_senha') ?>" data-toggle="tooltip" title="Alterar a sua senha no SOLICITASI" class="btn btn-light">Alterar Senha</a>

            </div>
        </div>
    </div>   
</div>
<P></P>



