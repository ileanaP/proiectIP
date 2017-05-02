<div class="col-md-3">
    <div class="list-group">
        <form role="form" action="{{ route('deleteOrganizers') }}" method="POST">
            {{ csrf_field() }}
            <h3>Organizatori actuali: </h3>
            @foreach($org as $organizer)
                <input type="text" class="list-group-item" value="{{$organizer->name}}" readonly><input type="checkbox" name="org_{{$organizer->id}}" value="{{$organizer->id}}">Sterge
            @endforeach
            <br>
            <button type="submit" class="btn btn-success"> Submit </button>
        </form>
    </div>
</div>