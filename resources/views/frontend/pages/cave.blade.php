@extends('frontend.layout.layout')

@section('content')
    <section class="site-section-cave" style="background-image: url('{{ asset('images/cave.jpg') }}')">
        <div class="site-section-cave-opacity"></div>
        <div class="site-section-cave-text absolute text-center p-2">
            <h1>La Cave à vin</h1>
            <p>Découvrez notre cave en ligne, où vins, champagnes et spiritueux d'exception vous attendent. Chaque
                bouteille est sélectionnée avec soin pour offrir une expérience unique, que ce soit pour un repas ou une
                célébration. Laissez-vous séduire par notre gamme de produits raffinés et authentiques.</p>
            <div class="mt-[2rem]">
                <a href="{{ route('sections', ['section' => $section->slug]) }}">Découvrir nos vins</a>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-xl md:text-2xl uppercase font-bold mb-4">Nos Services</h2>
                <p class=" max-w-2xl mx-auto">
                    Un savoir-faire d’exception pour vous offrir les plus grands vins et vous accompagner dans chaque
                    dégustation.
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="group bg-gradient-to-br from-amber-50 to-red-50 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div
                        class="bg-[#333333] w-16 h-16 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="mdi mdi-glass-wine text-3xl text-white"></span>
                    </div>
                    <h3 class="text-2xl font-bold text-[#333333] mb-4">Vente de Vins</h3>
                    <p class="text-gray-600 mb-6">
                        Sélection rigoureuse de grands crus et vins d'exception provenant des meilleurs domaines français et
                        internationaux.
                    </p>
                </div>

                <div
                    class="group bg-gradient-to-br from-amber-50 to-red-50 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div
                        class="bg-[#333333] w-16 h-16 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="mdi mdi-certificate text-3xl text-white"></span>
                    </div>
                    <h3 class="text-2xl font-bold text-[#333333] mb-4">Conservation</h3>
                    <p class="text-gray-600 mb-6">
                        Caves climatisées optimales pour la conservation de vos précieux millésimes dans les meilleures
                        conditions.
                    </p>
                </div>

                <div
                    class="group bg-gradient-to-br from-amber-50 to-red-50 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div
                        class="bg-[#333333] w-16 h-16 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="mdi mdi-account text-3xl text-white"></span>
                    </div>
                    <h3 class="text-2xl font-bold text-[#333333] mb-4">Dégustations</h3>
                    <p class="text-gray-600 mb-6">
                        Expériences de dégustation guidées par nos sommeliers experts dans un cadre d'exception.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gradient-to-b from-red-900 to-red-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-xl md:text-2xl uppercase font-bold text-white mb-4">Nos Grands Crus</h2>
                <p class="text-white max-w-2xl mx-auto">
                    Une sélection exceptionnelle des meilleurs terroirs
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="bg-white rounded-2xl shadow-2xl overflow-hidden transition-transform flex flex-col justify-between duration-300">
                    <img src="{{ asset('images/others/vin.jpg') }}" alt="Vin du quotidien"
                        class="w-full h-64 object-cover" />
                    <div class="p-6">

                        <h3 class="text-xl font-bold text-red-900 mb-2">Plaisirs du quotidien</h3>
                        <p class="text-gray-600 mb-4">
                            Offrez-vous l’élégance au quotidien : des vins accessibles mais raffinés, aux arômes équilibrés
                            de fruits rouges et d’épices, parfaits pour sublimer vos repas de tous les jours.
                        </p>
                        <div class="flex justify-center items-center">
                            <a href="{{ route('sections', ['section' => $section->slug]) }}"
                                class="bg-red-900 text-white px-4 py-2 rounded-lg hover:bg-red-800 transition-colors">
                                En savoir plus
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-2xl overflow-hidden transition-transform flex flex-col justify-between duration-300">
                    <img src="{{ asset('images/others/vin2.jpg') }}" alt="Champagne" class="w-full h-64 object-cover" />
                    <div class="p-6">

                        <h3 class="text-xl font-bold text-red-900 mb-2">Partages entre amis</h3>
                        <p class="text-gray-600 mb-4">
                            Rendez chaque moment convivial inoubliable avec un champagne d’exception, aux bulles fines et
                            délicates, idéal pour célébrer la joie et la complicité.
                        </p>
                        <div class="flex justify-center items-center">
                            <a href="{{ route('sections', ['section' => $section->slug]) }}"
                                class="bg-red-900 text-white px-4 py-2 rounded-lg hover:bg-red-800 transition-colors">
                                En savoir plus
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-2xl overflow-hidden transition-transform flex flex-col justify-between duration-300">
                    <img src="{{ asset('images/others/vin2.jpg') }}" alt="Bourgogne" class="w-full h-64 object-cover" />
                    <div class="p-6">

                        <h3 class="text-xl font-bold text-red-900 mb-2">Instants d’exception</h3>
                        <p class="text-gray-600 mb-4">
                            Savourez l’excellence avec un Bourgogne rouge élégant, aux tanins soyeux et à la finale
                            persistante, pensé pour accompagner vos plus grands moments.
                        </p>
                        <div class="flex justify-center items-center">
                            <a href="{{ route('sections', ['section' => $section->slug]) }}"
                                class="bg-red-900 text-white px-4 py-2 rounded-lg hover:bg-red-800 transition-colors">
                                En savoir plus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://images.pexels.com/photos/1407847/pexels-photo-1407847.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop"
                        alt="Cave à vin traditionnelle" class="rounded-2xl shadow-2xl" />
                </div>
                <div>
                    <h2 class="text-4xl font-bold text-[#333333] mb-6">Un Cadre d’Exception</h2>
                    <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                        Située au cœur de la ville de Cotonou, la <span class="font-bold">Cave à vin du CPF</span> est bien
                        plus qu’une simple cave : c’est un espace dédié aux passionnés de grands vins. Dans un cadre
                        chaleureux et élégant, chaque détail a été pensé pour mettre en valeur notre sélection de crus
                        d’exception.
                    </p>
                    <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                        Nos rayons raffinés et notre mise en scène soignée invitent à la découverte, tandis que nos
                        sommeliers vous conseillent avec expertise pour trouver la bouteille idéale, que ce soit pour un
                        plaisir quotidien, un cadeau ou un moment d’exception.
                    </p>
                    <div class="grid grid-cols-3 gap-6 text-center">
                        <div>
                            <div class="text-3xl font-bold text-[#333333] mb-2">5+</div>
                            <div class="text-gray-600">Ans d'expérience</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-[#333333] mb-2">500+</div>
                            <div class="text-gray-600">Bouteilles en cave</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="py-20 bg-gradient-to-b from-amber-50 to-red-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-xl md:text-2xl uppercase font-bold mb-4">Nous Contacter</h2>
                <p class="">
                    Venez découvrir notre cave et déguster nos sélections
                </p>
            </div>
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg text-center hover:shadow-xl transition-shadow">
                    <span class="mdi mdi-map text-3xl text-red-900 mx-auto mb-4"></span>
                    <h3 class="text-xl font-bold text-[#333333] mb-2">Adresse</h3>
                    <p class="text-gray-600">
                        En face SONEB Gbegamey<br />
                        Cotonou, Benin
                    </p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg text-center hover:shadow-xl transition-shadow">
                    <span class="mdi mdi-phone text-3xl text-red-900 mx-auto mb-4"></span>
                    <h3 class="text-xl font-bold text-[#333333] mb-2">Téléphone</h3>
                    <p class="text-gray-600">
                        +229 44430051<br />
                        contact@cpf-vignes.com
                    </p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg text-center hover:shadow-xl transition-shadow">
                    <span class="mdi mdi-clock text-3xl text-red-900 mx-auto mb-4"></span>
                    <h3 class="text-xl font-bold text-[#333333] mb-2">Horaires</h3>
                    <p class="text-gray-600">
                        Lun-Sam: 9h00-19h00<br />
                        Dimanche: 10h00-18h00
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
