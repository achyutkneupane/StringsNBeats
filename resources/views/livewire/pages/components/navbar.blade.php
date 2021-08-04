<div class='col-12'>
    <div class="py-2 text-white col-12 bg-primary d-flex justify-content-between text-uppercase h6">
        <div class="p-1 align-middle d-flex">
            <a class="text-white nav-link" href="{{ asset('/') }}">Home</a>
            <a class="text-white nav-link" href="{{ route('contactUs') }}">Contact Us</a>
            @auth
            <a class="text-white nav-link" href="{{ route('adminDashboard') }}" data-turbolinks="false">Panel</a>
            @endauth
        </div>
        <div class="pt-1 text-white h3">
            <a href="https://www.facebook.com/StringsNBeatsNepal" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.769.931-2.692 3.029-2.692h1.971v3z" fill='white'/></svg></a>
            <a href="https://www.instagram.com/stringsnbeats" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" fill='white'/></svg></a>
            <a href="https://www.twitter.com/strings_beats" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" fill='white'/></svg></a>
            <a href="mailto:info@stringsnbeats.net" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 12.713l-11.985-9.713h23.971l-11.986 9.713zm-5.425-1.822l-6.575-5.329v12.501l6.575-7.172zm10.85 0l6.575 7.172v-12.501l-6.575 5.329zm-1.557 1.261l-3.868 3.135-3.868-3.135-8.11 8.848h23.956l-8.11-8.848z" fill='white'/></svg></a>
        </div>
    </div>
    <div class="my-2 bg-white col-12 d-flex flex-column justify-content-between sticky-top" style='z-index: 50;'>
        <span class="text-center col-12 text-danger text-uppercase display-4">
            <img src="{{ asset('statics/logo-text.webp') }}" class='my-0 logoimg my-md-2' alt="Strings N' Beats" title="Strings N' Beats" loading='lazy'>
        </span>
        @if(request()->routeIs('homepage'))
        <h1 style='display:none'>Strings N' Beats</h1>
        @endif
        <div class="d-flex justify-content-center col-12">
            <div class="p-0 text-white col-12 bg-primary d-flex justify-content-between align-items-center">
                <a class="py-3 m-0 text-white nav-link bg-danger h-100 d-flex align-items-center" href="{{ route('homepage') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 13v10h-6v-6h-6v6h-6v-10h-3l12-12 12 12h-3zm-1-5.907v-5.093h-3v2.093l3 3z" fill='white'/></svg>
                </a>
                {{-- <a class="py-3 text-white nav-link">The Top Tens</a>
                <a class="py-3 text-white nav-link">Discography</a>
                <a class="py-3 text-white nav-link">News</a>
                <a class="py-3 text-white nav-link">Releases</a>
                <a class="py-3 text-white nav-link">Artists</a> --}}
                @if(request()->path() == 'livewire/message/pages.components.navbar' || request()->path() == '/')
                <div class='px-2 pt-2 pb-2 categoryBar'>
                    <input type="text" class='rounded form-control' wire:model='queryTerm' placeholder='Search For Articles'>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@push('styles')
<style>
    .categoryBar {
        width: 100%;
    }
    .logoimg {
        width: 75%;
    }
    @media (min-width: 992px) {
        .categoryBar {
            max-width: 35%;
        }
        .logoimg {
            width: 50%;
        }
    }
</style>
@endpush