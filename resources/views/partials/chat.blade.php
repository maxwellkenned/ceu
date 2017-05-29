<div class="panel panel-default ">
    <div class="panel-heading">Messenger</div>
    <div class="panel-body">
        <aside id="users_online">
            <div class="lista_users">
                <ul>
                    @if(isset($usuarios))
                        @foreach ($usuarios as $user)
                        <li id="{{$user['id']}}">
                            <div class="imgSmall"><img src="{{$user['foto'] != ''?'users/fotos/'.$user['id'].'/'.$user['foto']:'fotos/default.jpg'}}" border="0" /></div>
                            <a href="" id="{{Auth::user()->id}}:{{$user['id']}}" class="comecar">{{$user['name']}}</a>
                            <span id="{{$user['id']}}" class="status {{$user['status']}}"></span>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </aside>
    </div>
</div>