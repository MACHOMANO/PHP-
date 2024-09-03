<?php
    
    
    include 'db.php';
    
    
    $id = $_GET['id'];

    if($_server['REQUEST_METHOD'] == 'POST'){

        $name = $_post['Name'];
        $email = $_post['Email'];
    
        $sql = "DELETE from user WHERE id = '$id'";

        if($conn -> query($sql) === true){
            echo "Registro editado com sucesso.";
        }else {
            echo "erro" . $sql . "<br>" . $conn ->error;
        }
        $conn -> close();
        header ("location: read.php");
        exit();
    }

    $sql = "SELECT * from user where id=$id";
    $result =$conn -> query($sql);
    $row = $result -> fetch_assoc();



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="DELETE.php <?php echo $row ['id']; ?>" method="POST">
    <label for="name">Nome:</label>
    <input type="text" name="name" required>
    <label for="name">Email</label>
    <input type="email" name="name">
    <input type="submit" value="atualizar">  
    </form>
</body>
</html>