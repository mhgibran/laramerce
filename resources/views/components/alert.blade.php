@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('success') ?? 'Success' }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (Session::has('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ Session::get('warning') ?? 'Warning' }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif