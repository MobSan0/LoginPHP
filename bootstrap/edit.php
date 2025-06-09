<?php
require_once 'connect.php';
require_once 'header.php';

echo "<div class='container'>";

// Verificação de permissão reforçada
if(!isset($_SESSION['role']) {
    header('Location: login.php');
    exit;
}

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    // Apenas administradores podem editar
    if($_SESSION['role'] !== 'admin') {
        echo "<div class='alert alert-danger'>Acesso negado. Apenas administradores podem editar usuários.</div>";
        require_once 'footer.php';
        exit;
    }
} else {
    header('Location: users.php');
    exit;
}

// Restante do código de edição...
?>

<h2>Editar Usuário</h2>
<form action="" method="POST">
    <input type="hidden" name="userid" value="<?php echo $row['user_id']; ?>">
    
    <div class="form-group">
        <label>Nome</label>
        <input type="text" name="firstname" class="form-control" value="<?php echo $row['firstname']; ?>" required>
    </div>
    
    <div class="form-group">
        <label>Sobrenome</label>
        <input type="text" name="lastname" class="form-control" value="<?php echo $row['lastname']; ?>" required>
    </div>
    
    <div class="form-group">
        <label>Endereço</label>
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="rua" class="form-control" value="<?php echo $row['rua']; ?>" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="numero" class="form-control" value="<?php echo $row['numero']; ?>" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="bairro" class="form-control" value="<?php echo $row['bairro']; ?>" required>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4">
                <input type="text" name="cidade" class="form-control" value="<?php echo $row['cidade']; ?>" required>
            </div>
            <div class="col-md-2">
                <select name="estado" class="form-control" required>
                    <option value="<?php echo $row['estado']; ?>"><?php echo $row['estado']; ?></option>
                    <!-- Lista completa de estados -->
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" name="cep" class="form-control" value="<?php echo $row['cep']; ?>" required>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label>Contato</label>
        <input type="text" name="contact" class="form-control" value="<?php echo $row['contact']; ?>" required>
    </div>
    
    <input type="submit" name="update" class="btn btn-primary" value="Atualizar">
</form>

<?php
require_once 'footer.php';
?>