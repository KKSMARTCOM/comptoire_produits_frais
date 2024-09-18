<p>
    Commande N : {{ $order_no }}
</p>
<p>
    Nom du client : {{ $lastname }}
</p>
<p>
    Prénom du client : {{ $firstname }}
</p>
<p>
    Nom d'entreprise : {{ $company_name }}
</p>
<p>
    Adresse complete : {{ $address }}
</p>
<p>
    Ville : {{ $city }}
</p>
<p>
    Quartier : {{ $district }}
</p>
<p>
    Téléphone : {{ $phone }}
</p>
<p>
    Note : {{ $note }}
</p>
<h2>Detail de la commande</h2>
@foreach ($cart as $item)
    <p>
        {{ $item['product']['name'] }} : {{ $item['product']['price'] }} * {{ $item['quantity'] }} =
        {{ $item['total'] }}</br>
    </p>
@endforeach
<p>
    Total de la commande : {{ $totalCartPrice }}
</p>
