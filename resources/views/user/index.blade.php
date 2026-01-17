@extends('layouts.app')

@section('content')
<br>
<div class="container mt-4">
    <div class="row justify-content-center container-users">
        <div class="col-md-8">
            <form action="{{ route('user.index') }}" method="GET" id="buscador" style="float: right; width: 300px;">
                <div class="row">
                    <div class="form-group col">
                        <input type="text" id="search" class="form-control" style="width: 200px;">
                    </div>
                    <div class="form-group col btn-search">
                        <input type="submit" value="Buscar" class="btn btn-dark" style="width: 70px;">
                    </div>
                </div>
            </form>
            <h2>Gente</h2>
            <hr>

            @include('includes.message')
            @foreach($users as $user)
                <div class="box">
                    <a href="{{ route('profile', ['id' => $user->id]) }}" style="color: black;">
                        <div class="profile-user">
                            @if($user->image)
                            <div class="container-avatar" style="float: left;">
                                <img src="{{ route('user.avatar', ['filename'=>$user->image]) }}" alt="" class="avatar">
                            </div>
                            @endif

                            <div class="user-info">
                                <div  class="user-fullname">
                                    <h3>{{'@'.$user->nick}}</h3>
                                    <h3>{{$user->name.' '.$user->surname}}</h3>
                                </div>
                                <p>{{'Se unio: '.\FormatTime::LongTimeFilter($user->created_at)}}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            @endforeach
            <br><br>
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection