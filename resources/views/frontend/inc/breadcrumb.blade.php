<div class="bg-light py-3 site-breadcrumb" style="background-image: url('{{ asset('images/banner.jpg') }}')">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12 mb-0">
                <a href="{{ route('index') }}">Acceuil</a>
                @if (!empty($breadcrumb['pages']))
                    @foreach ($breadcrumb['pages'] as $br)
                        <span class="mx-2 mb-0">/</span>
                        <a href="{{-- {{ $br['link'] }} --}}">{{ ucfirst($br['name']) }}</a>
                    @endforeach
                @endif
                <span class="mx-2 mb-0">/</span>
                <strong class="text-black">{{ $breadcrumb['active'] ?? '' }}</strong>
            </div>
        </div>
    </div>
</div>
