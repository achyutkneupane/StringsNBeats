<div>
    @section('title','ShortUrl')
    <div class="pt-4 content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-center">
                            <div class="card col-lg-10">
                                <div class="card-body">
                                    <p class="card-text">
                                        <div class="container">
                                            <div class="form-group">
                                                <input type="text" id="long" wire:model.lazy="long" placeholder='Insert Long Url' class="form-control">
                                                @error('long')
                                                    <div class="my-2 text-center alert alert-danger" role='alert'>{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="short" wire:model.lazy="short" placeholder='Insert Redirect tag' class="form-control">
                                                @error('short')
                                                    <div class="my-2 text-center alert alert-danger" role='alert'>{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="description" wire:model.lazy="description" placeholder='Insert Description' class="form-control">
                                                @error('description')
                                                    <div class="my-2 text-center alert alert-danger" role='alert'>{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button class='btn btn-success' wire:click='shorten'>Shorten</button>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-center">
                            <div class="card col-lg-10">
                                <div class="card-body">
                                    <p class="card-text">
                                        <div class="container">
                                            <div class='form-group'>
                                                <input type="text" class='form-control' placeholder="Search Term" wire:model="searchTerm" />
                                            </div>
                                            <table class="table">
                                                <thead class="thead-dark">
                                                  <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Long</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Short</th>
                                                    <th scope="col">Clicks</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($links as $link)
                                                    <tr>
                                                      <th scope="row">{{ $loop->iteration }}</th>
                                                      <td>{{ $link->long }}</td>
                                                      <td>{{ $link->description }}</td>
                                                      <td>{{ $link->tag }}</td>
                                                      <td>{{ $link->count }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                              </table>
                                        </div>
                                    </p>
                                </div>
                                @if ($links->hasPages())
                                <div class="card-footer text-muted">
                                    {{ $links->links() }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
@endpush
@push('scripts')
@endpush