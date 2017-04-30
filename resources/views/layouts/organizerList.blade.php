<div class="col-md-3">
    <div class="list-group">
        @foreach($org as $organizer)
            <input type="text" class="list-group-item" value="{{$organizer->name}}" readonly>
        @endforeach
    </div>
</div>