<?php
session_start();
$nome_marca = $_POST['nome_marca'] ?? '';
$pais_origem   = $_POST['pais_origem'] ?? '';


$dsn = "pgsql:host=localhost;port=5432;dbname=lojinha";

$usuario = "postgres";
$senha = "";

try {
    $pdo = new PDO($dsn, $usuario, $senha);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conectado com sucesso!";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$sql = "INSERT INTO marcas (nome_marca,pais_origem) 
        VALUES (:n, :p)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':n' => $nome_marca,
    ':p' => $pais_origem
]);

echo "Marca inserida com id " . $pdo->lastInsertId();

?>