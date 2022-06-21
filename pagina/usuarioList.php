<?php
include "../database/bd.php";
include "./head.php";
?>
<h2>Listagem Clientes</h2>
<div class="row">
    <form action="./usuarioList.php" method="post" class="form-inline">
        <div class="col">
            <input type="text" name="valor" class="form-control mb-2 mr-sm-2" placeholder="Pesquisar" />
        </div>
        <div class="col">
            <select name="tipo" class="custom-select">
                <option value="nome" selected>Nome</option>
                <option value="cpf">CPF</option>
            </select>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-outline-success mb-2 mr-sm-0">Buscar</button>
        </div>
        <div class="col">
            <a href="./usuarioForm.php" class="btn btn-primary">Cadastrar</a> <br>
        </div>
    </form>
</div>

<?php
$objBD = new BD();
$objBD->conn();
$tb_name = "usuario";

if (!empty($_POST['valor'])) {
    $result = $objBD->pesquisar($tb_name, $_POST);
} else {
    $result = $objBD->select($tb_name);
}

if (!empty($_GET['id'])) {
    $objBD->remover($tb_name, $_GET['id']);
    header("location: usuarioList.php");
}

echo "<table class='table table-hover'>
<thead>

                <tr>

                    <th scope='col'>ID</th>
                    <th scope='col'>Nome</th>
                    <th scope='col'>Telefone</th>
                    <th scope='col'> CPF</th>
                    <th scope='col'> Ação</th>
                    <th scope='col'> Ação</th>
                </tr>
                </thead>
                <tbody>
            ";
foreach ($result as $item) {
    echo "
        <tr>
            <th scope='row>" . $item['id'] . "</th>
            <td>" . $item['nome'] . "</td>
            <td>" . $item['telefone'] . "</td>
            <td>" . $item['cpf'] . "</td>
            <td><a href='./usuarioForm.php?id=" . $item['id'] . "'>Editar</a></td>
            <td><a href='./usuarioList.php?id=" . $item['id'] . "'
                   onclick=\"return confirm('Deseja realmente remover o registro?') \" >Deletar</a></td>
        </tr>";
}
echo "</tbody> </table>";
?>
<a href="../index.php">Voltar</a>
<?php
include "./footer.php";
?>