<div class="py-3 text-center text-white col-12 bg-primary d-flex flex-column justify-content-center text-uppercase">
    <div>Copyright &copy;{{ now()->format('Y') }}</div>
    <div class="text-danger">{{ config('app.name') }}</div>
</div>
@section('styles')
@endsection