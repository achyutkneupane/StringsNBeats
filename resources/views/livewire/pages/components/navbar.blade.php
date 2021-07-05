<div class="py-2 text-white border col-12 bg-primary d-flex justify-content-between text-uppercase h6">
    <div class="p-1 align-middle d-flex">
        <a class="text-white nav-link" href="{{ asset('/') }}">Home</a>
        {{-- <a class="text-white nav-link" href="{{ route('aboutUs') }}">About Us</a> --}}
        <a class="text-white nav-link" href="{{ route('contactUs') }}">Contact Us</a>
        @auth
        <a class="text-white nav-link" href="{{ route('adminDashboard') }}">Panel</a>
        @endauth
    </div>
    <div class="pt-1 text-white h3">
        <a href="https://www.facebook.com/StringsNBeatsNepal/" target="_blank"><i class="text-white fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/stringsnbeats/" target="_blank"><i class="text-white fab fa-instagram"></i></a>
        <a href="http://www.twitter.com/strings_beats" target="_blank"><i class="text-white fab fa-twitter"></i></a>
        <a href="mailto:info@stringsnbeats.net" target="_blank"><i class="text-white fas fa-envelope"></i></a>
    </div>
</div>
<div class="my-2 bg-white col-12 d-flex flex-column justify-content-between sticky-top" style='z-index: 50;'>
    <h1 class="text-center col-12 text-danger text-uppercase display-4 logoText">
        {{ config('app.name') }}
    </h1>
    <div class="d-flex justify-content-center col-12">
        <div class="p-0 text-white col-12 bg-primary d-flex justify-content-start text-uppercase">
            <a class="py-3 m-0 text-white nav-link bg-danger" href="{{ route('homepage') }}"><i class="fas fa-home"></i></a>
            {{-- <a class="py-3 text-white nav-link">The Top Tens</a>
            <a class="py-3 text-white nav-link">Discography</a>
            <a class="py-3 text-white nav-link">News</a>
            <a class="py-3 text-white nav-link">Releases</a>
            <a class="py-3 text-white nav-link">Artists</a> --}}
        </div>
    </div>
</div>
@push('styles')
<style>
    @font-face {
        font-family: 'Futura Poster';
        src: URL("{{ asset('statics/ftpstrps.ttf') }}");
    }
    .logoText {
        font-family: 'Futura Poster';
    }
</style>
@endpush