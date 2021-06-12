<div class="d-flex flex-column">
    <h3 class="py-1 mt-4 text-center text-white col-12 font-weight-bold text-uppercase bg-danger">
        Popular Articles
    </h3>
    <div class="flex-wrap d-flex justify-content-evenly">
        @for($i=1;$i<=4;$i++)
        <div class="col-md-3">
            @livewire('pages.components.home.post-component', ['i' => $i])
        </div>
        @endfor
    </div>
</div>