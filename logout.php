<?php
// ==========================================================
// YANIMMA E ISABELLA - EI32
// Redirecionamento automático para a página de login
// ==========================================================

// A função header() envia um cabeçalho HTTP ao navegador.
// Aqui, ela instrui o navegador a redirecionar o usuário
// automaticamente para o arquivo "login.php".
header("Location: login.php");

// A função exit encerra imediatamente a execução do script PHP,
// garantindo que nenhuma linha de código abaixo (se existisse)
// seja executada após o redirecionamento.
exit;
?>

