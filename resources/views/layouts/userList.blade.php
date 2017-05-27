<div class="col-md-3">
    <div class="list-group">
        <select name="userId">
            @foreach($users as $user)
                @if(($user->type != '3') && ($user->type != '1'))
                    <option value={{$user->id}}>{{$user->name}} {{$user->surname}}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>