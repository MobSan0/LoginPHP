<?php 
require_once 'connect.php';
require_once 'header.php';

echo "<div class='container'>";

if(isset($_POST['delete']) && $_SESSION['role'] === 'admin') {
    $sql = "DELETE FROM users WHERE user_id=" . (int)$_POST['userid'];
    if($con->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Usuário removido com sucesso</div>";
    }
}

$sql = "SELECT * FROM users";
$result = $con->query($sql); 
?>
    <h2>Lista de Todos os Usuários</h2>
    <table class="table table-bordered table-striped">
        <tr>
            <td>Nome</td>
            <td>Sobrenome</td>
            <td>Usuário</td>
            <td>Tipo</td>
            <td>Cidade/UF</td>
            <td>Contato</td>
            <?php if($_SESSION['role'] === 'admin'): ?>
            <td width="70px">Remover</td>
            <td width="70px">Editar</td>
            <?php endif; ?>
        </tr>
        <?php while($row = $result->fetch_assoc()) { 
            echo "<form action='' method='POST'>";
            echo "<input type='hidden' name='userid' value='".$row['user_id']."'>";
            echo "<tr>";
            
            echo "<td>".htmlspecialchars($row['firstname'])."</td>";
            echo "<td>".htmlspecialchars($row['lastname'])."</td>";
            echo "<td>".htmlspecialchars($row['username'])."</td>";
            echo "<td>".($row['role'] === 'admin' ? 'Admin' : 'User')."</td>";
            echo "<td>".htmlspecialchars($row['cidade']."/".$row['estado'])."</td>";
            echo "<td>".htmlspecialchars($row['contact'])."</td>";
            
            if($_SESSION['role'] === 'admin') {
                echo "<td><button type='submit' name='delete' class='btn btn-danger'>Remover</button></td>";
                echo "<td><a href='edit.php?id=".$row['user_id']."' class='btn btn-info'>Editar</a></td>";
            }
            
            echo "</tr>";
            echo "</form>";
        } ?>
    </table>
</div>
<?php 
require_once 'footer.php';
?>