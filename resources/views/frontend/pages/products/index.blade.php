<!DOCTYPE html>
<html>
<head>
    <title>Nos Produits</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>Nos Produits</h1>
    </header>

    <main>
        <section class="product-list">
            @foreach ($products as $product)
                <div class="product">
                    <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}">
                    <h2>{{ $product['name'] }}</h2>
                    <p>Prix: {{ $product['price'] }} €</p>
                    <a href="#">Ajouter au panier</a>
                </div>
            @endforeach
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Comptoir des Produits Frais</p>
    </footer>
</body>
</html>
