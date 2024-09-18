<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sistema_pedidos_reinaldo";

$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn -> connect_error){
    die("Conexão falhou :( Ó: ".$conn -> connect_error);
}; 

if(isset($_POST['create'])){
    $nomecliente = $_POST['nome_cliente'];
    $nomeproduto = $_POST['nome_produto'];
    $quantidade = $_POST['quantidade'];
    $data = $_POST['data_pedido'];
    $sql = "INSERT INTO pedidos (nome_cliente, nome_produto, quantidade, data_pedido) VALUE ('$nomecliente','$nomeproduto','$quantidade','$data')";

    if ($conn->query($sql) === TRUE) {
        echo "Pedido Adicionado com sucesso.";
    } else {
        echo "Erro
         ".$sql."<br>".$conn->error;
    }

    } 

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $nomecliente = $_POST['nome_cliente'];
        $nomeproduto = $_POST['nome_produto'];
        $quantidade = $_POST['quantidade'];
        $data = $_POST['data_pedido'];

        $sql = "UPDATE pedidos SET nome_cliente='$nomecliente', nome_produto='$nomeproduto', quantidade='$quantidade', data_pedido='$data' where id=$id";
    
        if ($conn->query($sql) === TRUE) {
            echo "Pedido alterado com sucesso.";
        } else {
            echo "Erro".$sql."<br>".$conn->error;
        }
    
        } 
    


    $sql = "SELECT * FROM pedidos";
    
    $result = $conn -> query($sql);
    
    if ($result -> num_rows > 0){
        echo "<table border='1'>
            <tr>
                <th> id </th>
                <th> nome_cliente </th>
                <th> nome_produto </th>
                <th> quantidade </th>
                <th> data_pedido </th>
            </tr>";
                while($row = $result -> fetch_assoc()){ 
                echo "<tr>
                        <td>{$row['id']} </td>
                        <td>{$row['nome_cliente']} </td>
                        <td>{$row['nome_produto']} </td>
                        <td>{$row['quantidade']} </td>
                        <td>{$row['data_pedido']} </td>
                    </tr>";
            }
        echo "</table>";
    }else{
        echo "Nenhum registro encontrado.";
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>filete</title>
</head>
<body>
    <form method="POST" id="create ">
        <label for="nome_cliente">Nome do cliente: </label>
        <input type="text" name="nome_cliente" required>
        <label for="nome_produto">Nome do produto: </label>
        <input type="text" name="nome_produto" required>
        <label for="quantidade">quantidade: </label>
        <input type="number" name="quantidade" required>
        <label for="data_pedido">data: </label>
        <input type="date" name="data_pedido" required>
        <input type="submit" name ='create' value="Adicionar">
    </form>
    <form method="POST">
        <h2>UPDATE</h2>
        <input type="number" name="id" placeholder="id" required>
        <input type="text" name="nome_cliente" placeholder="nome_cliente" required>
        <input type="text" name="nome_produto" placeholder="nome_produto" required>
        <input type="number" name="quantidade" placeholder="quantidade" required>
        <input type="date" name="data_pedido" placeholder="data_pedido" required>
        <input type="submit" name ='update' value="Atualizar">
    </form>
    <br>
</body>
</html>



  



