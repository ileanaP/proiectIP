<div class="col-md-3">
    <div class="list-group">
        <select name="userId">
            @foreach($users as $user)
                <option value={{$user->id}}>{{$user->name}} {{$user->surname}}</option>
            @endforeach
        </select>
    </div>
</div>