<div class="col-12 mt-5 mb-2">
    <div class="container">
        <div class="d-flex justify-content-between row">
            <div class="col-md-12 d-flex flex-column justify-content-center items-center">
                <h3 class="text-center text-uppercase">
                    Contact Us
                </h3>
                <div class="text-center">
                    You can reach us using the form below:
                </div>
                @if(!empty($formSubmitted))
                <div class="row d-flex justify-content-center">
                    <div class="alert alert-danger text-center col-6" role="alert">
                        {{ $this->formSubmitted }}
                    </div>
                </div>
                @endif
                <div class="row my-4 justify-content-center">
                    <div class="d-flex flex-column col-lg-7">
                        <div class="form-group col-12">
                            <label>Name</label>
                            <input type="text" wire:model.lazy="name" placeholder="Enter Full Name" class="form-control" wire:loading.attr="disabled" wire:target='sendContact'>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label>Email</label>
                            <input type="email" wire:model.lazy="email" placeholder="Enter Email Address" class="form-control" wire:loading.attr="disabled" wire:target='sendContact'>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label>Message</label>
                            <textarea wire:model.lazy="message" placeholder="Enter Your Message" class="form-control" rows="5" wire:loading.attr="disabled" wire:target='sendContact'></textarea>
                            @error('message')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12 d-flex justify-content-center">
                            <button class="btn btn-danger" wire:click="sendContact" wire:loading.attr="disabled">
                                <div wire:loading wire:target='sendContact'>
                                    Sending.............
                                </div>
                                <div wire:loading.remove wire:target='sendContact'>
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