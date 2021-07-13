<div>
    <title>Add Youtube</title>
    <div class="bg-right bg-cover d-flex flex-column justify-items-center justify-content-center vw-100 vh-100" style="background-image:url('https://raw.githubusercontent.com/tailwindtoolbox/App-Landing-Page/ff1042aa10dfc4e403014c1223d92172632a7d1e/bg.svg');">
        <div class="my-2 text-center display-4">
            <label for="channel">Youtube Store</label>
        </div>
        @if(session()->has('ChannelSaved'))
        <div class="my-2 text-center alert alert-success" role='alert'>
            {!! session('ChannelSaved') !!}
        </div>
        @endif
        <div class="px-4 my-2 text-center">
            <input type="text" id="channel" wire:model.lazy="channel" placeholder='Insert Youtube Channel' class="p-3 border">
            @error('channel')
                <div class="my-2 text-center alert alert-danger" role='alert'>{{ $message }}</div>
            @enderror
        </div>
        <div class="my-2 text-center">
            <input class="p-3 btn btn-danger" type="submit" value='Store Channel' wire:click='saveChannel'>
        </div>
        <form method="post" wire:submit.prevent="saveVideo" class="mx-auto vw-50 d-flex flex-column">
            @csrf
            @if(session()->has('VideoSaved'))
            <div class="my-2 text-center alert alert-success" role='alert'>
                {!! session('VideoSaved') !!}
            </div>
            @endif
            <div class="px-4 my-2 text-center">
                <input type="text" id="video" wire:model.lazy="videoLink" placeholder='Insert Youtube Video tag' class="p-3 border">
                @error('videoLink')
                    <div class="my-2 text-center alert alert-danger" role='alert'>{{ $message }}</div>
                @enderror
            </div>
            <div class="my-2 text-center">
                <input class="p-3 btn btn-danger" type="submit" value='Store Video'>
            </div>
        </form>
        <div class="text-xl text-center">
            We have stored <div class="text-danger d-inline">{{ $channels }}</div> channels and total <div class="d-inline text-danger">{{ $links }}</div> youtube links.
        </div>
    </div>
</div>