<?php $v->layout("_theme", ["title" => "Usuários"]); ?>

<div class="row">
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center">
        <form id="formCadastroDeInquilinos" class="linhaInquilinos ocultar" action="<?= url('source/Models/Registration/Inquilinos.php'); ?>">
            <h2>Cadastro de inquilinos</h2>
            <input type="text" name="nome" placeholder="nome" class="form-control mt-3">
            <input type="number" name="idade" placeholder="idade" class="form-control mt-3">
            <div class="border">
                <input type="radio" name="sexo" id="sexoFeminino" value="feminino">
                <label for="sexoFeminino">Feminino</label>
                <input type="radio" name="sexo" id="sexoMasculino" value="masculino">
                <label for="sexoMasculino">Masculino</label>
                <input type="radio" name="sexo" id="sexoOutro" value="outro">
                <label for="sexoOutro">Outro</label>
            </div>
            <input type="text" name="telefone" placeholder="telefone" class="form-control mt-3 telefoneMask">
            <input type="text" name="email" placeholder="email" class="form-control mt-3">
            <select name="unidade" class="form-select mt-3" id="selectComUnidades">
                <option>Selecione a Unidade:</option>                
            </select>
            <button type="submit" class="form-control btn btn-outline-success my-3">Cadastrar</button>
        </form>
    </div>
    <div class="col-2 text-center">&nbsp;</div>
</div>

<div class="row">
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center">        
        <form id="formCadastroDeUnidades" class="linhaUnidades ocultar" action="<?= url('source/Models/Registration/Unidades.php'); ?>">            
            <h2>Cadastro de Unidades de um condomínio</h2>
            <input type="text" name="identificacao" placeholder="identificação" class="form-control">
            <input type="text" name="proprietario" placeholder="proprietário" class="form-control">
            <input type="text" name="condominio" placeholder="condomínio" class="form-control">
            <input type="text" name="endereco" placeholder="endereço" class="form-control">
            <button type="submit" class="form-control btn btn-outline-success my-3">Cadastrar</button>
        </form>
    </div>
    <div class="col-2 text-center">&nbsp;</div>
</div>
<div class="row">
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center">        
        <form id="formCadastroDeDespesas" class="linhaDespesas ocultar" action="<?= url('source/Models/Registration/Despesas.php'); ?>">
            <h2>Cadastro de Despesas das unidades</h2>
            <select name="unidade" class="form-select mt-3" id="selectDespesasComUnidades">
                <option>Selecione a Unidade:</option>
                <option></option>
            </select>
            <input type="text" name="descricao" placeholder="descrição" class="form-control mt-3">
            <input type="text" name="tipo_despesa" placeholder="tipo_despesa" class="form-control mt-3">
            <input type="text" name="valor" placeholder="valor" class="form-control mt-3">
            <input type="datetime-local" name="vencimento_fatura" placeholder="vencimento_fatura" class="form-control mt-3">
            <input type="text" name="status_pagamento" placeholder="status_pagamento" class="form-control mt-3">            
            <button type="submit" class="form-control btn btn-outline-success my-3">Cadastrar</button>
        </form>
    </div>  
</div>
<div class="row">
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center" id="linhaListagemDeInquilinos"></div>
    <div class="col-2 text-center">&nbsp;</div>
</div>
<div class="row">
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center" id="linhaListagemDeUnidades"></div>
    <div class="col-2 text-center">&nbsp;</div>
</div>
<div class="row">
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center" id="linhaListagemDeDespesas"></div>
    <div class="col-2 text-center">&nbsp;</div>
</div>
<div class="row">
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center" id="linhaEdicaoDeInquilinos"></div>
    <div class="col-2 text-center">&nbsp;</div>
</div>
<div class="row">
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center" id="linhaEdicaoDeUnidades"></div>
    <div class="col-2 text-center">&nbsp;</div>
</div>
<div class="row">
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center" id="linhaEdicaoDeDespesas"></div>
    <div class="col-2 text-center">&nbsp;</div>
</div>

<?php $v->start("js"); ?>
    <script src="<?= url("/theme/assets/js/Listing/Inquilinos.js"); ?>"></script>
    <script src="<?= url("/theme/assets/js/Listing/Unidades.js"); ?>"></script>
    <script src="<?= url("/theme/assets/js/Listing/Despesas.js"); ?>"></script>    
    <script src="<?= url("/theme/assets/js/Edition/Inquilinos.js"); ?>"></script>
    <script src="<?= url("/theme/assets/js/Edition/Unidades.js"); ?>"></script>
    <script src="<?= url("/theme/assets/js/Edition/Despesas.js"); ?>"></script>    
    <script src="<?= url("/theme/assets/js/Registration/Inquilinos.js"); ?>"></script>
    <script src="<?= url("/theme/assets/js/Registration/Unidades.js"); ?>"></script>
    <script src="<?= url("/theme/assets/js/Registration/Despesas.js"); ?>"></script>
<?php $v->end(); ?>