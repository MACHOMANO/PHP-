<?php
// Conexão com o Banco de Dados
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "atv_dupla2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexão falhou: " . $e->getMessage());
}

// Funções CRUD
function criarNota($conn, $titulo, $conteudo) {
    $sql = "INSERT INTO notas (titulo, conteudo) VALUES (:titulo, :conteudo)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':conteudo', $conteudo);
    return $stmt->execute() ? "Nota criada com sucesso!" : "Erro ao criar nota.";
}

function listarNotas($conn) {
    $sql = "SELECT * FROM notas";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function atualizarNota($conn, $id, $titulo, $conteudo) {
    $sql = "UPDATE notas SET titulo = :titulo, conteudo = :conteudo WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':conteudo', $conteudo);
    $stmt->bindParam(':id', $id);
    return $stmt->execute() ? "Nota atualizada com sucesso!" : "Erro ao atualizar nota.";
}

function excluirNota($conn, $id) {
    $sql = "DELETE FROM notas WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute() ? "Nota excluída com sucesso!" : "Erro ao excluir nota.";
}

// Lógica de Controle via Métodos GET e POST
$mensagem = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['criar'])) {
        $titulo = $_POST['titulo'];
        $conteudo = $_POST['conteudo'];
        $mensagem = criarNota($conn, $titulo, $conteudo);
    } elseif (isset($_POST['atualizar'])) {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $conteudo = $_POST['conteudo'];
        $mensagem = atualizarNota($conn, $id, $titulo, $conteudo);
    } elseif (isset($_POST['excluir'])) {
        $id = $_POST['id'];
        $mensagem = excluirNota($conn, $id);
    }
}

$notas = listarNotas($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bloco de Notas</title>
</head>
<body>
    <h1>Sistema de Bloco de Notas</h1>
    <p><?php echo $mensagem; ?></p>

    <h2>Criar Nota</h2>
    <form method="post">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required><br><br>
        <label for="conteudo">Conteúdo:</label><br>
        <textarea name="conteudo" id="conteudo" rows="5" cols="40" required></textarea><br><br>
        <button type="submit" name="criar">Criar Nota</button>
    </form>

    <h2>Notas</h2>
    <?php foreach ($notas as $nota): ?>
        <div style="border: 1px solid #000; padding: 10px; margin-bottom: 10px;">
            <h3><?php echo htmlspecialchars($nota['titulo']); ?></h3>
            <p><?php echo nl2br(htmlspecialchars($nota['conteudo'])); ?></p>
            <p><small>Data de Criação: <?php echo $nota['data_criacao']; ?></small></p>
            <form method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $nota['id']; ?>">
                <label for="titulo">Novo Título:</label>
                <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($nota['titulo']); ?>" required><br><br>
                <label for="conteudo">Novo Conteúdo:</label><br>
                <textarea name="conteudo" rows="3" cols="30" required><?php echo htmlspecialchars($nota['conteudo']); ?></textarea><br><br>
                <button type="submit" name="atualizar">Atualizar Nota</button>
                <button type="submit" name="excluir">Excluir Nota</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>
</html>
