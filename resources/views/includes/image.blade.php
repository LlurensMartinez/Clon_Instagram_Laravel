<div class="card" id="pub_image">
    <div class="card-header">

        @if($image->user->image)
        <div class="container-avatar">
            <img src="{{ route('user.avatar',['filename'=>$image->user->image])}}" alt="Image" class="imageNav"/>
        </div>
        @endif

        <div class="data-user">
            <a href="{{ route('profile', ['id' => $image->user->id])}}">
                {{ $image->user->name.' '.$image->user->surname }}
            </a>
            <span class="nickname">
                <b>{{' | @'.$image->user->nick}}</b>
            </span>
        </div>

    </div>

    <div class="card-body">
        <div class="image-container">
            <a href="{{ route('image.detail', ['id' => $image->id])}}">
                <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="">
            </a>
        </div>

        <div class="iconsContainer">
            <div class="likes">
                {{-- Comprobar si el usuario le dio Like a la imagen --}}
                <?php $user_like= false; ?>
                @foreach ($image->likes as $like )
                    @if($like->user_id == Auth::user()->id)
                    <?php $user_like= true; ?>
                    @endif
                @endforeach

                @if($user_like)
                {{-- Le pasamos la id de la imagen a JS --}}
                <i class="fas fa-heart" data-id="{{ $image->id }}"></i>
                @else
                <i class="far fa-heart" data-id="{{ $image->id }}"></i>
                @endif
            </div>
            {{ count($image->likes) }}
            <div class="comments">
                <a href="{{ route('image.detail', ['id' => $image->id])}}"><i class="far fa-comments"></i></a>
            </div>
        </div>

        <div class="description">
            <p class="nickname"><b>{{'@'.$image->user->nick}}</b> {{$image->description}}</p>

        </div>

        <div class="commentsCount">
            @if( count($image->comments) <= 0)
             <h4>Todavía no hay comentarios</h4>
            @else
            <a href="{{ route('image.detail', ['id' => $image->id])}}">
                Ver los {{ count($image->comments)}} Comentarios
            </a>
            @endif
        </div>

        <div class="dateContainer">
            <span class="date">{{ \FormatTime::LongTimeFilter($image->created_at) }}</span>
        </div>

    </div>

</div>
