    <div class="card-header">
        @if($image->user->image)
            <div class="container-avatar">
                <img src="{{ route('user.avatar', ['filename'=>$image->user->image]) }}" alt="" class="avatar">
            </div>
        @endif
        <div class="data-user">
                <a href="{{ route('profile', ['id' => $image->user->id]) }}">
                {{$image->user->name.' '.$image->user->surname}}
                <span class="nickname">
                    {{' | @'.$image->user->nick}}
                </span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="image-container">
            <img src="{{ route('image.file', ['filename' => $image->image]) }}" alt="">
        </div>
        <div class="descripcion">
            <div class="mt-1">
                <span class="nickname">{{'@'.$image->user->nick}}</span>
                <p class="likes">
                    <?php $user_like = false; ?>
                    @foreach($image->likes as $like)
                        @if($like->user->id == Auth::user()->id)
                            <?php $user_like = true; ?>
                        @endif
                    @endforeach
                    @if($user_like)
                        <img src="{{ asset('img/heart-red.png') }}" alt="" data-id="{{ $image->id }}" class="btn-dislike">
                    @else
                        <img src="{{ asset('img/heart-black.png') }}" alt="" data-id="{{ $image->id }}" class="btn-like">
                    @endif

                    <span class="number_likes">{{count($image->likes)}}</span>
                </p>
                <span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
                <p>{{$image->description}}</p>
            </div>
            <hr>
        </div>
    </div>