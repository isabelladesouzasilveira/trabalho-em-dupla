<?php
// ==========================================================
// YANIMMA E ISABELLA - EI32
// Script responsável por registrar o pedido no banco de dados
// e redirecionar o usuário para a página de agradecimento
// ==========================================================

// Inclui o arquivo de conexão com o banco de dados.
// O arquivo "conexao.php" deve conter a variável $con com a conexão ativa.
include("conexao.php");

// Verifica se o formulário foi enviado via método POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Extrai os dados enviados pelo formulário.
    // Exemplo: $_POST['usuario'] vira $usuario, etc.
    extract($_POST);

    // Verifica se o botão "finalizar" foi pressionado.
    if (isset($finalizar)) {

        // Monta o comando SQL para inserir um novo pedido na tabela "pedidos".
        // Os valores são obtidos diretamente das variáveis extraídas do POST.
        $sql = "INSERT INTO pedidos (usuario, produto, valor, pagamento) VALUES ('$usuario', '$produto', '$valor', '$pagamento')";

        // Executa a consulta SQL no banco de dados.
        if (mysqli_query($con, $sql)) {

            // Se o pedido foi inserido com sucesso,
            // redireciona o usuário para a página de agradecimento.
            header("Location: agradecimento.php");
            exit; // Encerra o script após o redirecionamento.
        } else {
            // Caso ocorra um erro na execução do SQL,
            // define uma mensagem de erro para exibir ao usuário.
            $erro = "Erro ao registrar pedido!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Pagamento - Loja Abelhinhas</title>
<link rel="stylesheet" href="css/style.css">
<style>
/* ========================== */
/* 🐝 ESTILO PAGAMENTO */
/* ========================== */
body {
    background: #fffbee;
    font-family: 'Poppins', sans-serif;
    color: #444;
    margin: 0;
    padding: 0;
}

.navbar {
    background-color: #ffcc00;
    padding: 1rem;
    text-align: center;
    font-weight: bold;
    font-size: 1.3rem;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}

.container {
    max-width: 500px;
    margin: 3rem auto;
    background-color: #ffffff;
    padding: 2.5rem;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

.section-title {
    color: #ffb300;
    font-size: 1.8rem;
    margin-bottom: 1rem;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

form input[type="text"] {
    width: 100%;
    padding: 10px;
    margin: 7px 0;
    border: 2px solid #ffe066;
    border-radius: 8px;
    font-size: 1rem;
    transition: 0.3s;
}

form input[type="text"]:focus {
    border-color: #ffb300;
    box-shadow: 0 0 6px rgba(255,179,0,0.4);
    outline: none;
}

.pagamento-opcao {
    display: inline-block;
    margin: 5px 10px;
    font-weight: 500;
    cursor: pointer;
}

.pagamento-opcao input {
    margin-right: 6px;
}

/* Campos extras */
.campo-pagamento {
    display: none;
    width: 100%;
    text-align: left;
    margin-top: 15px;
}

.campo-pagamento h4 {
    color: #ffb300;
    margin-bottom: 10px;
    border-bottom: 2px solid #ffec99;
    padding-bottom: 5px;
}

.campo-pagamento input {
    background: #fffaf0;
}

/* Botão principal */
.btn {
    background-color: #ffcc00;
    border: none;
    color: #333;
    font-weight: bold;
    padding: 12px 25px;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 15px;
    transition: 0.3s;
    width: 100%;
}

.btn:hover {
    background-color: #ffb300;
    box-shadow: 0 4px 8px rgba(255,179,0,0.3);
}

/* Mensagem de erro */
.erro {
    color: red;
    font-weight: bold;
    margin-top: 10px;
}
</style>

<script>
// ==========================================================
// Função: mostrarCampos(opcao)
// Professor, usei essa função para controlar qual forma de pagamento aparece na tela.
// Assim, quando o usuário escolhe entre cartão, pix ou boleto, só os campos
// referentes à opção selecionada ficam visíveis. Isso deixa o formulário
// mais limpo e evita confusão.
// ==========================================================

function mostrarCampos(opcao) {
    // Se o usuário escolher "cartão", mostro os campos de cartão
    // e escondo os outros.
    document.getElementById('cartao').style.display = (opcao === 'cartao') ? 'block' : 'none';

    // Se escolher "pix", mostra só o campo do PIX.
    document.getElementById('pix').style.display = (opcao === 'pix') ? 'block' : 'none';

    // Se for "boleto", mostro apenas as informações do boleto.
    document.getElementById('boleto').style.display = (opcao === 'boleto') ? 'block' : 'none';
}
</script>


</head>
<body>
<header class="navbar">
    <div class="logo">🐝 Loja Abelhinhas</div>
</header>

<section class="container">
    <h2 class="section-title">Pagamento</h2>

    <form method="post" action="">
        <input type="text" name="usuario" placeholder="Seu usuário" required>
        <input type="text" name="produto" placeholder="Produto" required>
        <input type="text" name="valor" placeholder="Valor (R$)" required>

        <label>Forma de pagamento:</label>
        <div>
            <label class="pagamento-opcao"><input type="radio" name="pagamento" value="cartao" onclick="mostrarCampos('cartao')"> 💳 Cartão</label>
            <label class="pagamento-opcao"><input type="radio" name="pagamento" value="boleto" onclick="mostrarCampos('boleto')"> 🧾 Boleto</label>
            <label class="pagamento-opcao"><input type="radio" name="pagamento" value="pix" onclick="mostrarCampos('pix')"> 🔑 Pix</label>
        </div>

        <!-- Campos de pagamento -->
        <div id="cartao" class="campo-pagamento">
            <h4>💳 Dados do Cartão</h4>
            <input type="text" name="numero_cartao" placeholder="Número do Cartão">
            <input type="text" name="nome_cartao" placeholder="Nome Impresso no Cartão">
            <input type="text" name="validade" placeholder="Validade (MM/AA)">
            <input type="text" name="cvv" placeholder="CVV">
        </div>

        <div id="pix" class="campo-pagamento">
            <h4>🔑 Chave PIX</h4>
            <input type="text" name="chave_pix" placeholder="Digite sua chave PIX">
        </div>

        <div id="boleto" class="campo-pagamento">
            <h4>🧾 Dados para Boleto</h4>
            <input type="text" name="cpf" placeholder="CPF">
            <input type="text" name="endereco" placeholder="Endereço completo">
        </div>

        <input type="submit" name="finalizar" value="Finalizar Compra" class="btn">
    </form>

    <?php 
    // ==========================================================
// Exibição de mensagem de erro, caso exista
// ==========================================================

// Verifica se a variável $erro foi definida anteriormente no código.
// Isso normalmente ocorre quando algo deu errado (ex: login incorreto, falha no cadastro, etc.)
// Se a variável $erro existir, o PHP imprime um parágrafo <p>
// com a classe "erro", exiba a mensagem contida em $erro.
// Exemplo de saída: <p class='erro'>Usuário ou senha incorretos.</p>
    if(isset($erro)) echo "<p class='erro'>$erro</p>"; ?>
</section>
</body>
</html>
