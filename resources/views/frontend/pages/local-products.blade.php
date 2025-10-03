@extends('frontend.layout.layout')

@section('content')
    <section class="site-section-cave"
        style="background-image: url('https://images.pexels.com/photos/1300972/pexels-photo-1300972.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1280&fit=crop')">
        <div class="site-section-cave-opacity"></div>
        <div class="site-section-cave-text absolute text-center p-2">
            <h1 class="font-bold mb-6 ">
                Terroir & Saveurs</span>
            </h1>
            <p>Produits locaux • Fraîcheur garantie</p>
            <div class="mt-[2rem]">
                <a href="{{ route('sections', ['section' => 'produits-locaux']) }}">Découvrir nos produits</a>
            </div>
        </div>
    </section>

    <section id="produits" class="py-20 container px-[1rem] md:px-[3rem] mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-xl md:text-2xl uppercase font-bold mb-4">Nos Produits Locaux</h2>
            <p class="max-w-3xl mx-auto">
                Une sélection rigoureuse de produits frais et d'épicerie fine provenant directement de nos producteurs
                partenaires
            </p>
        </div>

        <div class="mb-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div
                    class="group bg-gradient-to-br from-green-50 to-yellow-50 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div
                        class="bg-green-700 w-16 h-16 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="mdi mdi-food-apple text-white text-3xl"></span>
                    </div>
                    <h4 class="text-2xl font-bold text-green-800 mb-4">Fruits & Légumes</h4>
                    <p class="text-gray-600 mb-6">
                        Fruits et légumes de saison cueillis à maturité. Pommes, poires, carottes, courgettes, tomates
                        cerises...
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-green-700 font-semibold">À partir de 1000 f/kg</span>
                        <a href="{{ route('sections', ['section' => 'produits-locaux']) }}"
                            class="text-green-700 font-semibold hover:text-green-600 flex items-center group-hover:translate-x-2 transition-transform">
                            Voir plus
                            <ChevronRight class="h-4 w-4 ml-1" />
                        </a>
                    </div>
                </div>

                <div
                    class="group bg-gradient-to-br from-green-50 to-yellow-50 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div
                        class="bg-green-700 w-16 h-16 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="mdi mdi-cheese text-white text-3xl"></span>
                    </div>
                    <h4 class="text-2xl font-bold text-green-800 mb-4">Produits Laitiers</h4>
                    <p class="text-gray-600 mb-6">
                        Lait, fromages, yaourts et beurre de nos fermes locales. Qualité artisanale et goût authentique.
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-green-700 font-semibold">À partir de 1000 f</span>
                        <a href="{{ route('sections', ['section' => 'produits-locaux']) }}"
                            class="text-green-700 font-semibold hover:text-green-600 flex items-center group-hover:translate-x-2 transition-transform">
                            Voir plus
                            <ChevronRight class="h-4 w-4 ml-1" />
                        </a>
                    </div>
                </div>

                <div
                    class="group bg-gradient-to-br from-green-50 to-yellow-50 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div
                        class="bg-green-700 w-16 h-16 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="mdi mdi-bread-slice text-white text-3xl"></span>
                    </div>
                    <h4 class="text-2xl font-bold text-green-800 mb-4">Boulangerie</h4>
                    <p class="text-gray-600 mb-6">
                        Pain artisanal, viennoiseries et pâtisseries fraîches. Farine locale et méthodes
                        traditionnelles.
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-green-700 font-semibold">À partir de 1000 f</span>
                        <a href="{{ route('sections', ['section' => 'produits-locaux']) }}"
                            class="text-green-700 font-semibold hover:text-green-600 flex items-center group-hover:translate-x-2 transition-transform">
                            Voir plus
                            <ChevronRight class="h-4 w-4 ml-1" />
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 w-full">
                @include('frontend.ajax.productList', ['products' => $products])
            </div>
        </div>
    </section>

    <section class="pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="h-[400px]">
                    <img src="{{ asset('images/others/store.jpg') }}" alt="Boutique"
                        class="rounded-2xl shadow-2xl h-full w-full object-cover" />
                </div>
                <div>
                    <h2 class="text-4xl font-bold text-[#333333] mb-6">Un Supermarché au Service de la Qualité</h2>
                    <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                        Notre supermarché vous propose bien plus qu’un simple lieu d’achat : un véritable espace dédié à la
                        fraîcheur, à la qualité et au plaisir de bien manger. Des fruits et légumes soigneusement
                        sélectionnés aux viandes et volailles issues de producteurs de confiance, en passant par un arrivage
                        quotidien de poissons et fruits de mer, chaque rayon reflète notre exigence.
                    </p>
                    <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                        À cela s’ajoute une offre complète en produits d’alimentation générale et d’épicerie fine, pensée
                        pour répondre à toutes vos envies, du quotidien aux grandes occasions.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
