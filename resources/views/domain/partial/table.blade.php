<button class="btn delete-multi-items" action-url="category/remove_category" redirect-url="/category"><i class="pg-trash"></i></button>
<table class="table table-hover" id="tableWithSearch">
    <thead>
    <tr>
        <th style="width:1%">
            <div class="checkbox">
                <input type="checkbox" name="check_all" data-id="checkbox" id="check_all">
                <label for="check_all"></label>
            </div>
        </th>
        <th style="width:20%">ID</th>
        <th style="width:20%">Name</th>
        <th style="width:20%">Position</th>
        <th style="width:20%">Displayed</th>
        <th style="width:20%">Action</th>
    </tr>
    </thead>
    <tbody>

    @foreach( $categories as $category )
        <tr>
            <td class="v-align-middle">
                <div class="checkbox ">
                    @if( $category->parent_id != 0 )
                        <input type="checkbox" name="item_ids[]" value={{$category->id}} data-id="checkbox" id="checkbox{{$category->id}}">
                        <label for="checkbox{{$category->id}}"></label>
                    @endif
                </div>
            </td>
            <td class="v-align-middle">
                <p>{{$category->id}}</p>
            </td>
            <td class="v-align-middle">
                <p>{{$category->name}}</p>
            </td>
            <td class="v-align-middle">
                <p>{{$category->position}}</p>
            </td>
            <td class="v-align-middle">
                <p>{{$category->active}}</p>
            </td>
            <td class="v-align-middle">
                <div class="btn-group btn-actions">
                    @if( $category->parent_id != 0 )
                        <button onclick="location.href='{{ route('category.edit', $category->id) }}'" type="button" class="btn edit-button"><i class="fa fa-pencil"></i></button>
                        <button title="Delete" item-ids="{{$category->id}}" type="button" class="btn create-button delete-single-item" action-url="category/remove_category" redirect-url="/category"><i class="fa fa-trash-o"></i></button>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>