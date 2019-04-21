


<div class="row">
    <div class="col-6">
        <div class="card ml-4 shadow p-4 mb-4 bg-white rounded" >
            <div class="card-body">
                <h5 class="card-title">Dados Pessoais</h5>

                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <td class="col-4"><span class="font-weight-bold">Nome: </span></td>
                            <td class="col-8"><?php echo mb_strtoupper($this->session->userdata('nome_admin')) ?></td>
                        </tr> 
                        <tr>
                            <td class="col-4"><span class="font-weight-bold">Email: </span></td>
                            <td class="col-8"><?php echo $this->session->userdata('email_admin') ?></td>
                        </tr>         
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card ml-4 shadow p-4 mb-4 bg-white rounded" >
            <div class="card-body">
                <h5 class="card-title">Configuração do Sistema</h5>

                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <td class="col-4"><span class="font-weight-bold">SemAno: </span></td>
                            <td class="col-8"><?php echo mb_strtoupper($this->session->userdata('semestreano')) ?></td>
                        </tr> 
                        <tr>
                            <td class="col-4"><span class="font-weight-bold">Dt. Final Ajuste: </span></td>
                            <td class="col-8"><?php echo mb_strtoupper($this->session->userdata('dt_final_ajuste')) ?></td>
                        </tr>
                        <tr>
                            <td class="col-4"><span class="font-weight-bold">Sist. em Manut: </span></td>
                            <td class="col-8"><?php echo $this->session->userdata('manutencao') ?></td>
                        </tr>
         
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>
<P></P>



