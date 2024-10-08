 @if ($packs && $packs->count() > 0)
     @foreach ($packs as $item)
         <div class="col-lg-4 col-md-6 site-section-box-container">
             <div class="site-section-box-image">
                 <img src="{{ asset($item->image) }}" alt="">
             </div>
             <div class="site-section-box-bottom">
                 <div class="site-section-box-bottom-text">
                     <h3>{{ ucfirst($item->name) }}</h3>
                     <p>{{ $item->price }} FCFA</p>
                     <p>{{ strLimit($item->description, 70) }}</p>

                 </div>
                 @php
                     $encrypt = encryptData($item->id);
                 @endphp
                 <div class="site-section-box-bottom-link">
                     {{-- <a href="{{ route('cart') }}"><span class="mdi mdi-eye-outline"></span></a> --}}
                     <form id="addForm" method="GET" action="{{ route('pack.item') }}">
                         @csrf
                         <input type="hidden" name="pack_id" value={{ $encrypt }}>
                         <p>
                             <button type="submit" id="panier" class="border-0 bg-transparent">
                                 <span class="mdi mdi-eye-outline"></span>
                             </button>
                         </p>
                     </form>
                 </div>
             </div>
             <div class="mt-4 d-flex align-items-end justify-content-end">
                 <form id="addForm" method="GET" action="{{ route('cart.form') }}">
                     @csrf
                     <input type="hidden" name="pack_id" value={{ $encrypt }}>
                     <button type="submit" class="button-link">
                         Commander
                     </button>
                 </form>
             </div>
         </div>
     @endforeach
 @else
     <p>Merci de votre intérêt pour nos coffrets et paniers de fêtes !
         Pour l’instant, aucun coffret n’est disponible, mais ne vous inquiétez pas, nous préparons de nouvelles
         surprises qui seront bientôt prêtes. <br>

         N’hésitez pas à revenir régulièrement consulter cette section, nos nouveautés festives arrivent très vite !
         <br>

         Nous avons hâte de vous proposer des offres exclusives qui sauront ravir vos papilles et celles de vos proches.
     </p>
 @endif
