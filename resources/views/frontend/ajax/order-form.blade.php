<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (nécessaire pour Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="orderForm" id="orderForm-{{ $formId }}" style="display: none;">
    <form action="{{ route('order.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name-{{ $formId }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Adresse :</label>
            <input type="text" name="address" id="address-{{ $formId }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email-{{ $formId }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Numéro de téléphone :</label>
            <input type="tel" name="phone" id="phone-{{ $formId }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Valider la commande</button>
    </form>
</div>
