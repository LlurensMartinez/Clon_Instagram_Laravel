@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')

            <div class="card pub_image_detail" id="pub_image">
                <div class="card-header">

                    @if($image->user->image)
                    <div class="container-avatar">
                        <img src="{{ route('user.avatar',['filename'=>$image->user->image])}}" alt="Image" class="imageNav"/>
                    </div>
                    @endif

                    <div class="data-user">
                        {{ $image->user->name.' '.$image->user->surname }}
                        <span class="nickname">
                            <b>{{' | @'.$image->user->nick}}</b>
                        </span>
                    </div>

                </div>

                <div class="card-body">
                    <div class="image-container">
                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="Image">
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

                            <input class="count" value="{{ count($image->likes) }}">

                        @if(Auth::user() && Auth::user()->id == $image->user->id)
                        <div class="actionEdit">
                            <a href="{{ route('image.edit', ['id' => $image->id]) }}"><i class="far fa-edit"></i></a>
                        </div>

                        <div class="actionDelete">
                            <a href="{{ route('image.delete', ['id' => $image->id]) }}" data-toggle="modal" data-target="#myModal"><i class="fas fa-trash-alt"></i></a>

                            @include('includes.modal')

                        </div>
                        @endif

                    </div>

                    <div class="description">
                        <p class="nickname"><b>{{'@'.$image->user->nick}}</b> {{$image->description}}</p>
                    </div>

                    <div class="commentsCount">
                        @if( count($image->comments) <= 0)
                         <h2>Todavía no hay comentarios</h2>
                        @else
                        <h2>Comentarios</h2>
                        @endif
                        <hr>
                        @foreach ($image->comments as $comment)
                            <div class="comment">
                                <p>
                                    <b>{{'@'.$comment->user->nick}}</b> {{$comment->content}}
                                    @if(Auth::check() && ($comment->user_id == Auth::user()->id) || $comment->image->user_id === Auth::user()->id)
                                        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" id="delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    @endif
                                </p>

                            </div>
                            <div class="dateContainerComments">
                                <span class="date">{{ \FormatTime::LongTimeFilter($comment->created_at) }}</span>
                            </div>

                        @endforeach
                        <hr>

                        <form  method="POST" action="{{ route('comment.save') }}">
                            @csrf

                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <p>
                                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"></textarea>

                                @if($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                            </p>

                            <button class="btn btn-success" type="submit">
                                Enviar
                            </button>
                        </form>
                    </div>

                    <div class="dateContainer">
                        <span class="date">{{ \FormatTime::LongTimeFilter($image->created_at) }}</span>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
@endsection
