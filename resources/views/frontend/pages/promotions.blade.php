@extends('frontend.layout.layout')

@section('content')
    <div class="site-section-cave">
        <img src="{{ asset('images/others/cpf.jpg') }}" class="w-full h-full object-cover" alt="">
    </div>

    <div class="container py-12 px-[1rem] md:px-[3rem] mx-auto flex justify-center">
        <div class="max-w-7xl relative rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 shadow-xl">
            <!-- Dégradé décoratif -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#004200] to-green-600 opacity-80 rounded-2xl"></div>

            <div class="relative z-10 block md:flex items-center gap-4 p-[1rem] sm:p-[2rem] mt-[1rem] sm:mt-[0px]">
                <p class="text-white/90 text-sm md:text-lg ">
                    Découvrez nos offres exclusives et faites le plein de bonnes affaires ! Produits frais, viandes,
                    poissons, vins et épicerie : chaque semaine, profitez de prix irrésistibles sur vos indispensables du
                    quotidien comme sur vos envies gourmandes. Dépêchez-vous, ces offres sont limitées dans le temps !
                </p>
            </div>
        </div>
    </div>

    <div class="container px-[1rem] md:px-[3rem] mx-auto flex justify-center pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-[2rem]">
            <a href="{{ route('promotion', 'carte-de-fidelite') }}" class="cursor-pointer shadow-md bg-white rounded-lg">
                <div class="w-full h-[18rem] overflow-hidden">
                    <img src="{{ asset('images/others/fidelite.jpg') }}" class="object-cover w-full h-full rounded-t-lg"
                        alt="">
                </div>
                <div class="p-[1.5rem] space-y-4">
                    <h1 class="font-bold text-lg md:text-xl">Carte de Fidélité</h1>
                    <p class="text-sm md:text-lg">Avec la carte de fidélité, cumulez des points à chaque passage en caisse
                        et
                        profitez de réductions personnalisées. Une façon simple et avantageuse de vous récompenser pour
                        votre confiance, jour
                        après jour.</p>
                </div>
            </a>

        </div>
    </div>
@endsection
