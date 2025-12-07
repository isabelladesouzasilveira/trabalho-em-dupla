<?php
// YANIMMA E ISABELLA - EI32

// Variável simples usada como "chave" para confirmar login
$sessao = "";

// Aqui verificamos se o login foi recebido pela URL e se está marcado como "ok"
// Isso serve como um controle básico para não deixar entrar sem estar logado
if (isset($_GET['login']) && $_GET['login'] == 'ok') {
    $sessao = "ok";
}

// Se a sessão NÃO estiver "ok", o usuário é redirecionado para o login
// Isso impede acesso direto ao index digitando o link
if ($sessao != "ok") {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Loja Abelhinhas</title>
<link rel="stylesheet" href="css/style.css">

<style>
/* Toda essa parte aqui cuida do visual da página,
   deixando tudo organizado, bonito e com uma carinha profissional */

/* ====== ESTILO GERAL ====== */
body {
    font-family: 'Poppins', sans-serif; /* fonte mais elegante e moderna */
    margin: 0;
    padding: 0;
    background: #fffaf0; /* fundo clarinho com tom quente */
    color: #333;
}

/* ====== CABEÇALHO ====== */
.navbar {
    background-color: #ffcc00; /* amarelinho típico da loja */
    display: flex;
    justify-content: space-between; /* mantém menu e logo bem separados */
    align-items: center;
    padding: 1rem 2rem;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* sombrazinha leve pra destacar */
}
.logo {
    font-size: 1.5rem;
    font-weight: bold; /* logo marcante */
}
.nav-links {
    list-style: none;
    display: flex;
    gap: 1rem; /* espaçamento entre os links */
}
.nav-links a {
    text-decoration: none;
    color: #333;
    font-weight: 600;
    transition: 0.3s; /* deixa o hover suave */
}
.nav-links a:hover {
    color: #8b5e00; /* muda a cor quando passa o mouse */
}

/* ====== ÁREA PRINCIPAL ====== */
.container {
    padding: 2rem;
    text-align: center;
}
.section-title {
    font-size: 2rem;
    margin-bottom: 1.2rem;
    color: #444;
}
p {
    font-size: 1.1rem;
    color: #666;
}

/* ====== BARRA DE PESQUISA ====== */
.search-bar {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 2rem auto 3rem;
    gap: 0.6rem;
}
.search-bar input {
    padding: 0.8rem 1rem;
    width: 350px; /* tamanho confortável para digitar */
    border: 2px solid #ffcc00;
    border-radius: 50px; /* bordas bem redondinhas */
    outline: none;
    transition: 0.3s;
    font-size: 1rem;
}
.search-bar input:focus {
    border-color: #ffaa00; /* destaque suave ao clicar */
    box-shadow: 0 0 10px rgba(255, 187, 0, 0.5);
}
.search-bar .btn {
    padding: 0.8rem 1.5rem;
    border: none;
    background: linear-gradient(135deg, #ffcc00, #ffaa00);
    color: #fff;
    font-weight: bold;
    border-radius: 50px;
    cursor: pointer;
    transition: 0.3s;
}
.search-bar .btn:hover {
    transform: scale(1.05);
    box-shadow: 0 0 10px rgba(255,170,0,0.4);
}

/* ====== ÁREA DOS PRODUTOS ====== */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 2rem;
    justify-items: center; /* centraliza os cards */
}
.product-card {
    background-color: #fff;
    border-radius: 15px;
    padding: 1.5rem;
    width: 220px; /* tamanho padrão de cada card */
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    transition: 0.3s;
}
.product-card:hover {
    transform: translateY(-5px); /* efeito de levantar quando passa o mouse */
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
}
.product-image {
    width: 100%;
    border-radius: 10px;
    margin-bottom: 0.8rem;
}
.product-price {
    color: #8b5e00;
    font-weight: bold;
    margin-bottom: 0.8rem;
}

/* ====== BOTÕES (COMPRAR / ADICIONAR AO CARRINHO) ====== */
/* Esses botões aqui foram ajustados pra ficarem menores e do mesmo tamanho */
.btn {
    background: linear-gradient(135deg, #ffcc00, #ffaa00);
    color: white;
    border: none;
    padding: 0.45rem 0.9rem;   /* tamanho compacto */
    font-size: 0.85rem;        /* texto menor e mais proporcional */
    border-radius: 25px;       /* bordas arredondadas suaves */
    cursor: pointer;
    transition: 0.3s;
    margin: 0.2rem;
    width: 150px;              /* largura fixa: todos ficam iguais */
    text-align: center;        /* texto centralizado */
}

.btn:hover {
    background: linear-gradient(135deg, #ffaa00, #ff9900);
    transform: scale(1.05); /* leve animação ao passar o mouse */
}

/* Mantém os dois botões alinhadinhos um do lado do outro */
.product-actions {
    display:flex;
    justify-content:center;
    gap:8px;
    align-items:center;
    flex-wrap:wrap;
}

/* ====== RODAPÉ ====== */
footer {
    background-color: #ffcc00;
    color: #333;
    text-align: center;
    padding: 1rem 0;
    font-weight: bold;
    box-shadow: 0 -4px 8px rgba(0,0,0,0.05);
}
</style>
</head>

<body>

<header>
    <nav class="navbar">
        <div class="logo">🐝 Loja Abelhinhas</div>

        <!-- Checkbox usado para menu responsivo (mobile) -->
        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="menu-icon">☰</label>

        <ul class="nav-links">
            <li><a href="logout.php">Sair</a></li>

            <!-- Link para o carrinho, mantendo login ativo -->
            <li><a href="carrinho.php?login=ok">Carrinho</a></li>
        </ul>
    </nav>
</header>

<section class="container" style="text-align:center;">
    <h1 class="section-title">Bem-vindo à Loja Abelhinhas!</h1>
    <p>Aqui você encontra as melhores roupas infantis com amor e conforto.</p>
</section>

<section class="container">
    <h2 class="section-title">Nossos Produtos</h2>

    <!-- Barra de busca dos produtos -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Pesquisar produtos...">
        <button class="btn" onclick="filtrarProdutos()">Buscar</button>
    </div>

    <!-- Galeria de produtos -->
    <div class="products-grid" id="listaProdutos">

        <!-- Cada bloco abaixo é um produto da loja -->
        <!-- O botão “Comprar” envia para pagamento direto -->
        <!-- O botão “Adicionar ao Carrinho” envia nome e preço via GET -->

        <div class="product-card">
            <img src="img/roupa1.jpg" class="product-image" alt="">
            <h3>Vestido Abelhinha</h3>
            <p class="product-price">R$ 89,90</p>
            <div class="product-actions">
                <a href="pagamento.php"><button class="btn">Comprar</button></a>
                <a href="carrinho.php?produto=Vestido%20Abelhinha&preco=89.90&login=ok"><button class="btn">Adicionar ao Carrinho</button></a>
            </div>
        </div>

        <!-- Os restantes seguem o mesmo padrão, mudando apenas nome, imagem e preço -->

        <div class="product-card">
            <img src="img/roupa2.jpg" class="product-image" alt="">
            <h3>Conjunto Floral</h3>
            <p class="product-price">R$ 119,90</p>
            <div class="product-actions">
                <a href="pagamento.php"><button class="btn">Comprar</button></a>
                <a href="carrinho.php?produto=Conjunto%20Floral&preco=119.90&login=ok"><button class="btn">Adicionar ao Carrinho</button></a>
            </div>
        </div>

        <div class="product-card">
            <img src="img/roupa3.jpg" class="product-image" alt="">
            <h3>Camiseta Colmeia</h3>
            <p class="product-price">R$ 49,90</p>
            <div class="product-actions">
                <a href="pagamento.php"><button class="btn">Comprar</button></a>
                <a href="carrinho.php?produto=Camiseta%20Colmeia&preco=49.90&login=ok"><button class="btn">Adicionar ao Carrinho</button></a>
            </div>
        </div>

        <div class="product-card">
            <img src="img/roupa4.jpg" class="product-image" alt="">
            <h3>Conjunto Infantil</h3>
            <p class="product-price">R$ 89,90</p>
            <div class="product-actions">
                <a href="pagamento.php"><button class="btn">Comprar</button></a>
                <a href="carrinho.php?produto=Conjunto%20Infantil&preco=89.90&login=ok"><button class="btn">Adicionar ao Carrinho</button></a>
            </div>
        </div>

        <div class="product-card">
            <img src="img/roupa5.jpg" class="product-image" alt="">
            <h3>Vestido Infantil</h3>
            <p class="product-price">R$ 79,90</p>
            <div class="product-actions">
                <a href="pagamento.php"><button class="btn">Comprar</button></a>
                <a href="carrinho.php?produto=Vestido%20Infantil&preco=79.90&login=ok"><button class="btn">Adicionar ao Carrinho</button></a>
            </div>
        </div>

        <div class="product-card">
            <img src="img/roupa6.jpg" class="product-image" alt="">
            <h3>Chapéu Infantil</h3>
            <p class="product-price">R$ 39,90</p>
            <div class="product-actions">
                <a href="pagamento.php"><button class="btn">Comprar</button></a>
                <a href="carrinho.php?produto=Chapeu%20Infantil&preco=39.90&login=ok"><button class="btn">Adicionar ao Carrinho</button></a>
            </div>
        </div>

        <div class="product-card">
            <img src="img/roupa7.jpg" class="product-image" alt="">
            <h3>Jardineira Infantil</h3>
            <p class="product-price">R$ 59,90</p>
            <div class="product-actions">
                <a href="pagamento.php"><button class="btn">Comprar</button></a>
                <a href="carrinho.php?produto=Jardineira%20Infantil&preco=59.90&login=ok"><button class="btn">Adicionar ao Carrinho</button></a>
            </div>
        </div>

        <div class="product-card">
            <img src="img/roupa8.jpg" class="product-image" alt="">
            <h3>Pijama Infantil</h3>
            <p class="product-price">R$ 149,90</p>
            <div class="product-actions">
                <a href="pagamento.php"><button class="btn">Comprar</button></a>
                <a href="carrinho.php?produto=Pijama%20Infantil&preco=149.90&login=ok"><button class="btn">Adicionar ao Carrinho</button></a>
            </div>
        </div>

    </div>
</section>

<footer>
    <p>&copy; 2025 Loja Abelhinhas - Todos os direitos reservados a Loja Abelhinhas 🐝</p>
</footer>

<script>
// Função de busca simples e direta
// Ela pega o texto digitado e compara com o nome de cada produto
function filtrarProdutos() {
    var input = document.getElementById("searchInput").value.toLowerCase();
    var produtos = document.querySelectorAll(".product-card");
    var encontrou = false;

    produtos.forEach(function(produto) {
        var nome = produto.querySelector("h3").textContent.toLowerCase();

        // Se o nome combinar com a busca, mostra o produto
        if (nome.includes(input)) {
            produto.style.display = "block";
            encontrou = true;
        } else {
            produto.style.display = "none";
        }
    });

    // Se nada for encontrado, exibe um alerta
    if (!encontrou) {
        alert("Nenhum produto encontrado!");
    }
}
</script>

</body>
</html>
