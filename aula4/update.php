<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newName = $_POST['new_name'];
    $newEmail = $_POST['new_email'];

    $sql = "UPDATE user SET name = '$newName', email = '$newEmail' where id=6";
    if ($conn->query($sql) === TRUE) {
        echo "Atualização realidada com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE</title>
</head>

<body>
    <form method="POST" action="update.php">
        <label for="new_name">Novo nome: </label>
        <input type="text" name="new_name" required>
        <label for="new_email">Novo email: </label>
        <input type="text" name="new_email" required>
        <input type="submit" value="Adicionar">
    </form>
</body>

</html>


