<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert @if (! session('status') != 'error') alert-success @else alert-danger @endif" role="alert">
                    {{ session('message') ?? session('status') }}
                </div>
            @endif
        </div>
    </div>
</div>
