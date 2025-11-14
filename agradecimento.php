<!DOCTYPE html>
<!-- YANIMMA JULIA MEIRELES SILVA E ISABELLA DE SOUZA SILVEIRA - EI32 -->
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Obrigado!</title>
<link rel="stylesheet" href="css/style.css">
<style>
    /* ====== CSS para a página de agradecimento para a página de finalização da compra ====== */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(180deg, #fff9d8 0%, #ffe67c 100%);
    margin: 0;
    padding: 0;
    color: #444;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* ====== CABEÇALHO ====== */
.navbar {
    background-color: #ffcc00;
    text-align: center;
    padding: 1rem 0;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
.logo {
    font-size: 1.8rem;
    font-weight: bold;
}

/* ====== CONTEÚDO ====== */
.container {
    max-width: 500px;
    margin: auto;
    margin-top: 8vh;
    background: #fff;
    padding: 2.5rem 2rem;
    border-radius: 25px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    text-align: center;
    animation: aparecer 0.8s ease-out;
}

/* ====== ANIMAÇÃO ====== */
@keyframes aparecer {
    from {
        transform: scale(0.9);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

/* ====== TÍTULO ====== */
.section-title {
    font-size: 2rem;
    color: #333;
    margin-bottom: 0.8rem;
}

/* ====== TEXTO ====== */
.container p {
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

/* ====== BOTÃO ====== */
.btn {
    background: linear-gradient(135deg, #ffcc00, #ffaa00);
    border: none;
    color: #fff;
    padding: 0.9rem 2rem;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 4px 10px rgba(255,200,0,0.4);
}
.btn:hover {
    transform: scale(1.05);
    background: linear-gradient(135deg, #ffdd33, #ff9900);
    box-shadow: 0 0 12px rgba(255,170,0,0.5);
}

/* ====== RODAPÉ ====== */
footer {
    text-align: center;
    padding: 1rem;
    color: #666;
    margin-top: auto;
}

/* ====== RESPONSIVIDADE ====== */
@media (max-width: 480px) {
    .container {
        width: 85%;
        padding: 2rem 1rem;
    }
    .section-title {
        font-size: 1.6rem;
    }
}

</style>
</head>
<body>
<header class="navbar"><div class="logo">🐝 Loja Abelhinhas</div></header>
<section class="container" style="text-align:center;">
<h2 class="section-title">Compra Confirmada!</h2>
<p>Obrigado por comprar conosco 💛</p>
<a href="index.php?login=ok"><button class="btn">Voltar à Loja</button></a>
</section>
</body>
</html>
