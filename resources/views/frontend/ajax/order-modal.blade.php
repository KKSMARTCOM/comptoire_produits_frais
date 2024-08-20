<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (nécessaire pour Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="orderModal-{{ $formId }}" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel-{{ $formId }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel-{{ $formId }}">Valider la commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
        </div>
    </div>
</div>
