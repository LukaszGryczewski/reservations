<form action="{{ route('process.payment') }}" method="POST">
    @csrf
    <input type="hidden" name="show_id" value="{{ $show->id }}">
    <div class="form-group">
        <label for="card_number">Numéro de carte</label>
        <input type="text" name="card_number" id="card_number" class="form-control">
    </div>
    <div class="form-group">
        <label for="expiry_date">Date d'expiration</label>
        <input type="text" name="expiry_date" id="expiry_date" class="form-control">
    </div>
    <div class="form-group">
        <label for="cvc">CVC</label>
        <input type="text" name="cvc" id="cvc" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Payer</button>
</form>
