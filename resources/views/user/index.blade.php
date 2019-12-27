@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Usuarios de LaraGram</h1>

            <form action="GET" action="{{ route('user.index')}}" id="buscador">
                <div class="row">
                    <div class="form-group col">
                        <input type="text" id="search" class="form-control">
                    </div>
                    <div class="form-group col btn-search">
                        <input type="submit" value="Buscar" class="btn btn-success">
                    </div>
                </div>
            </form>
            <hr>
            @foreach ($users as $user)
                <div class="data-user">

                    @if($user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar',['filename'=>$user->image])}}" alt="Image" class="imageNav"/>
                        </div>
                    @endif

                    <div class="user-info">
                        <h2>{{ '@'.$user->nick }}</h2>
                        <h3>{{ $user->name }} {{ $user->surname}}</h3>
                        <p class="date">{{'Se unió hace '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
                        <a href="{{ route('profile', ['id' => $user->id])}}" class="btn btn-success">Ver Perfil</a>
                    </div>

                </div>
            @endforeach

            <!-- PAGINACION -->
            <div class="clearfix"></div>
            {{$users->links()}}
        </div>

    </div>
</div>
@endsection
