<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Fatura Ara') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/search" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" name="invoiceID" class="form-control" placeholder="Fatura numarası"
                                    aria-label="Fatura numarası" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Ara</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>