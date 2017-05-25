<select name="categoryId">
    @foreach($categories as $category)
        <option value={{$category->id}}>{{$category->category}}</option>
    @endforeach
</select>