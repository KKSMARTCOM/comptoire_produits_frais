@extends('frontend.layout.layout')

@section('content')
    <div class="site-section-cave">
        <img src="{{ asset('images/others/cpf.jpg') }}" class="w-full h-full object-cover" alt="">
    </div>

    <div class="container py-12 px-[1rem] md:px-[3rem] mx-auto flex justify-center">
        <div class="max-w-7xl leading-8 text-lg">
            <h1 class="font-bold text-xl md:text-2xl">La carte de fidélité CPF : Qui peut l'avoir et comment ?</h1>
            <p>Tous nos clients peuvent bénéficier de notre carte de fidélité gratuitement.</p>
            <h2 class="text-lg md:text-xl font-bold underline mt-4">Principe 1</h2>
            <p>A chaque tranche de trois (03) achats cumulés d'un montant total minimum de 10 000f, vous bénéficiez
                automatiquement d'une remise progressive sur votre prochain achat.</p>
            <h3 class="font-bold ">1er Palier : 5% de réduction</h3>
            <h2 class="text-lg md:text-xl font-bold underline mt-4">Principe 2</h2>
            <p>Votre sixième achat cumulé d'un montant minimum de 10 000f, vous offre le deuxième palier. La réduction est
                faite
                sur ce 6ème achat.</p>
            <h3 class="font-bold ">2è Palier : 10% de réduction</h3>
            <h2 class="text-lg md:text-xl font-bold underline mt-4">Principe 3</h2>
            <p>Votre dixième achat cumulé d'un montant minimum de 10 000f, vous fait bénéficier de 15% de réduction au
                palier 3.
                La réduction est accordée sur le montant de ce 10ème achat. <span class="font-bold">Et le cycle
                    recommence...</span></p>
            <h3 class="font-bold ">3è Palier : 15% de réduction</h3>
            <p>Venez profiter d'une expérience d'achat enrichissante où la qualité et le savoir-faire sont à l'honneur.</p>
        </div>
    </div>
@endsection
