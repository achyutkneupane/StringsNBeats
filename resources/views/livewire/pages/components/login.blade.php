<div class="mt-5 mb-2 col-12">
    <div class="container">
        <div class="d-flex justify-content-between row">
            <div class="items-center col-md-12 d-flex flex-column justify-content-center">
                <h3 class="text-center text-uppercase">
                    Sign In
                </h3>
                <div class="my-4 row justify-content-center">
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
                                    Logging In.............
                                </div>
                                <div wire:loading.remove wire:target='signIn'>
                                    Login
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>