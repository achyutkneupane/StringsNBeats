<div class="col-12 mt-5 mb-2">
    <div class="container">
        <div class="d-flex justify-content-between row">
            <div class="col-md-12 d-flex flex-column justify-content-center items-center">
                <h3 class="text-center text-uppercase">
                    Sign In
                </h3>
                <div class="row my-4 justify-content-center">
                    <div class="d-flex flex-column col-lg-7">
                        <div class="form-group col-12">
                            <label>Email</label>
                            <input type="email" wire:model.lazy="email" placeholder="Enter Email Address" class="form-control" wire:loading.attr="disabled" wire:target='signIn'>
                            @error('email')
                            <div class="text-danger">{!! $message !!}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label>Password</label>
                            <input type="password" wire:model.lazy="password" placeholder="Enter Password" class="form-control" wire:loading.attr="disabled" wire:target='signIn'>
                            @error('password')
                            <div class="text-danger">{!! $message !!}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12 d-flex justify-content-center">
                            <button class="btn btn-danger" wire:click="signIn" wire:loading.attr="disabled">
                                <div wire:loading wire:target='signIn'>
                                    Sending.............
                                </div>
                                <div wire:loading.remove wire:target='signIn'>
                                    Send
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>