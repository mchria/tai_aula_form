<?php
include "../database/bd.php";
include "./head.php";

$objBD = new BD();
$objBD->conn();
$tb_nome = "produto";

if (!empty($_GET['id'])) {
    $result = $objBD->buscar($tb_nome, $_GET['id']);
    //select * from produto where id = ?
}
if (!empty($_POST)) {

    if (empty($_POST['id'])) {
        $objBD->inserir($tb_nome, $_POST);
    } else {
        $objBD->update($tb_nome, $_POST);
    }
    header("Location: ./produtoList.php");
}
?>
<h2>Formulário Cliente</h2>
<form action="./usuarioForm.php" method="post">
<div class='row'>
    <input type="hidden" name="id" value="<?php echo !empty($result->id) ? $result->id : "" ?>" /><br>

    <div class="col-4">
    <label>Nome</label>
    <input type="text" name="nome" class="form-control" value="<?php echo !empty($result->nome) ? $result->nome : "" ?>" /><br>
</div>

    <div class="col-3">
    <label>Telefone</label>
    <input type="text" name="telefone" class="form-control" value="<?php echo !empty($result->telefone) ? $result->telefone : "" ?>" /><br>
    </div>
    </div>

    <div class='row'>
    <div class="col-3">
    <label>CPF</label>
    <input type="text" name="cpf" class="form-control" value="<?php echo !empty($result->cpf) ? $result->cpf : "" ?>" /><br>
    </div>
    </div>


</form>
<input type="submit" class="btn btn-success" value="Salvar" />
</form>
<a href="./usuarioList.php" class="btn btn-primary">Voltar</a> <br>
<?php
include "./footer.php";
?>