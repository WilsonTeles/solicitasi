<h3>Login</h3>
<?php echo form_open('aluno/login/validar_dados', array("class" => "form-horizontal")); ?>

 <span class="text-danger"><?php echo validation_errors(); ?></span>


<div class="form-group">
    <label for="matricula" class="col-md-6 control-label"><span class="text-danger">*</span>Matricula</label>
    <div class="col-md-2">
        <input type="text" name="matricula" value="<?php echo $this->input->post('matricula'); ?>" class="form-control" id="matricula" />
        <span class="text-danger"><?php echo form_error('matricula'); ?></span>
    </div>
</div>
<div class="form-group">
    <label for="senha" class="col-md-6 control-label"><span class="text-danger">*</span>Senha</label>
    <div class="col-md-2">
        <input type="password" name="senha" value="<?php echo $this->input->post('senha'); ?>" class="form-control" id="senha" />
        <span class="text-danger"><?php echo form_error('senha'); ?></span>
    </div>
</div>
<!-- <div class="form-group">
    <p></p>
    <label class="col-md-6 control-label"><?php echo $cap_img ?></label>
    <p></p>
    <label for="captcha" class="col-md-6 control-label"><span class="text-danger">*</span>Código Acima (não faz distinção maiúsculas e mínusculas)</label>
    <div class="col-md-2">
        <input autocomplete="off" type="text" name="captcha" value="" class="form-control" id="captcha" />
        <span class="text-danger"><?php echo form_error('captcha'); ?></span>
    </div>
</div> -->

<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" data-toggle="tooltip" title="Confirmar" class="btn btn-success"><i class="fas fa-check"></i></button>
        <a href="<?php echo site_url('Welcome') ?>" data-toggle="tooltip" title="Retornar" class="btn btn-warning btn-xs"><i class="fas fa-undo-alt"></i></a>
        <a href="<?php echo site_url('aluno/Login/esqueceu_senha') ?>" data-toggle="tooltip" title="Solicitar nova senha de acesso" class="btn btn-secondary btn-xs">Esqueci a senha <i class="fas fa-unlock"></i></a>
    </div>
</div>

<?php echo form_close(); ?>




