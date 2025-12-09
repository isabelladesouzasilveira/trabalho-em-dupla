<?php
// ==========================================================
// YANIMMA E ISABELLA - EI32
// Script responsável por registrar o pedido no banco de dados
// ==========================================================

include("conexao.php"); // Inclui a conexão com o banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    extract($_POST); // Extrai os dados enviados pelo formulário

    if (isset($finalizar)) {

        // Protege os campos contra caracteres especiais
        $produto = mysqli_real_escape_string($con, $produto);
        $usuario = mysqli_real_escape_string($con, $usuario);

        // Corrige o valor para gravar no DECIMAL corretamente
        // Substitui vírgula por ponto, garante 2 casas decimais
        $preco = str_replace(',', '.', $valor);
        $preco = number_format((float)$preco, 2, '.', '');

        // Monta o SQL para inserir o pedido
        $sql = "INSERT INTO pedidos (produto, preco, comprador)
                VALUES ('$produto', '$preco', '$usuario')";

        if (mysqli_query($con, $sql)) {
            header("Location: agradecimento.php");
            exit;
        } else {
            $erro = "Erro ao registrar pedido: " . mysqli_error($con);
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
body { background: #fffbee; font-family: 'Poppins', sans-serif; color: #444; margin: 0; padding: 0; }
.navbar { background-color: #ffcc00; padding: 1rem; text-align: center; font-weight: bold; font-size: 1.3rem; box-shadow: 0 3px 6px rgba(0,0,0,0.1);}
.container { max-width: 500px; margin: 3rem auto; background-color: #ffffff; padding: 2.5rem; border-radius: 15px; box-shadow: 0 6px 15px rgba(0,0,0,0.1);}
.section-title { color: #ffb300; font-size: 1.8rem; margin-bottom: 1rem;}
form { display: flex; flex-direction: column; align-items: center;}
form input[type="text"] { width: 100%; padding: 10px; margin: 7px 0; border: 2px solid #ffe066; border-radius: 8px; font-size: 1rem; transition: 0.3s;}
form input[type="text"]:focus { border-color: #ffb300; box-shadow: 0 0 6px rgba(255,179,0,0.4); outline: none;}
.pagamento-opcao { display: inline-block; margin: 5px 10px; font-weight: 500; cursor: pointer;}
.pagamento-opcao input { margin-right: 6px;}
.campo-pagamento { display: none; width: 100%; text-align: left; margin-top: 15px;}
.campo-pagamento h4 { color: #ffb300; margin-bottom: 10px; border-bottom: 2px solid #ffec99; padding-bottom: 5px;}
.campo-pagamento input { background: #fffaf0;}
.btn { background-color: #ffcc00; border: none; color: #333; font-weight: bold; padding: 12px 25px; border-radius: 8px; cursor: pointer; margin-top: 15px; transition: 0.3s; width: 100%;}
.btn:hover { background-color: #ffb300; box-shadow: 0 4px 8px rgba(255,179,0,0.3);}
.erro { color: red; font-weight: bold; margin-top: 10px;}
</style>

<script>
function mostrarCampos(opcao) {
    document.getElementById('cartao').style.display = (opcao === 'cartao') ? 'block' : 'none';
    document.getElementById('pix').style.display = (opcao === 'pix') ? 'block' : 'none';
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

    <?php if(isset($erro)) echo "<p class='erro'>$erro</p>"; ?>
</section>
</body>
</html>
