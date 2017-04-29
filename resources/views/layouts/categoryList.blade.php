<div class="col-md-3">
    <div class="list-group">
        <select name="categoryId">
        @foreach($categories as $category)
            <option value={{$category->id}}>{{$category->category}}</option>
        @endforeach
        </select>
    </div>
</div>