<div class="d-flex flex-column">
    <div class="row form-group">
        <div class="col-lg-6 my-1">
            <input type="text" wire:model.lazy="fullName" placeholder="Enter Your Name(Optional)" class="form-control">
            @error('fullName')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6 my-1">
            <input type="text" wire:model.lazy="email" placeholder="Enter Your Email(Optional)" class="form-control">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row form-group">
        <div class="col-12">
            <textarea wire:model.lazy="comment" placeholder="Enter Your Comment" rows="4" class="form-control"></textarea>
            @error('comment')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row form-group">
        <div class="col-12">
            <button class="btn btn-danger" wire:click="comment" wire:target='comment' wire:loading.attr="disabled">Comment</button>
        </div>
    </div>
    @if($comments->count() > 0)
    <div class="row">
    @foreach($comments as $comment)
    <div class="col-lg-12 border py-3 d-flex flex-column">
        <h5 class="text-danger">
            @if(!$comment->name && !$comment->email)
            Anonymous
            @elseif($comment->name && !$comment->email)
            {{ $comment->name }}
            @elseif(!$comment->name && $comment->email)
            <a href="mailto:{{ $comment->email }}" class="text-danger"><u>Anonymous</u></a>
            @else
            <a href="mailto:{{ $comment->email }}" class="text-danger"><u>{{ $comment->name }}</u></a>
            @endif
        </h5>
        <div>{{ $comment->content }}</div>
    </div>
    @endforeach
    </div>
    @else
    <div class="row">
        <div class="col-12 text-center border p-2">
            No Comments
        </div>
    </div>
    @endif
</div>
