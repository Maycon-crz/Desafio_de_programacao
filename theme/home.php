<?php $v->layout("_theme", ["title" => "Usuários"]); ?>

<div class="row border">    
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center border">
        <h2>Cadastro de inquilinos</h2>
        <form>
            <input type="text" name="" placeholder="nome" class="form-control mt-3">
            <input type="text" name="" placeholder="idade" class="form-control mt-3">
            <input type="text" name="" placeholder="sexo" class="form-control mt-3">
            <input type="text" name="" placeholder="telefone" class="form-control mt-3">
            <input type="text" name="" placeholder="email" class="form-control mt-3">

            <input type="text" name="" placeholder="identificação" class="form-control mt-3">
            <input type="text" name="" placeholder="proprietário" class="form-control mt-3">
            <input type="text" name="" placeholder="condomínio" class="form-control mt-3">
            <input type="text" name="" placeholder="endereço" class="form-control mt-3">
            <button class="form-control btn btn-outline-success my-3">Cadastrar</button>
        </form>
    </div>
    <div class="col-2 text-center">&nbsp;</div>
</div>

<div class="row border">    
    <div class="col-2 text-center">&nbsp;</div>
    <div class="col-8 text-center border">
        <h2>Unidades de um condomínio</h2>
        <form>
            <input type="text" name="" placeholder="descrição" class="form-control mt-3">
            <input type="text" name="" placeholder="tipo_despesa" class="form-control mt-3">
            <input type="text" name="" placeholder="valor" class="form-control mt-3">
            <input type="text" name="" placeholder="vencimento_fatura" class="form-control mt-3">
            <input type="text" name="" placeholder="status_pagamento" class="form-control mt-3">
            <button class="form-control btn btn-outline-success my-3">Cadastrar</button>
        </form>
    </div>
    <div class="col-2 text-center">&nbsp;</div>
</div>


<?php $v->start("js"); ?>
<script>    
</script>
<?php $v->end(); ?>