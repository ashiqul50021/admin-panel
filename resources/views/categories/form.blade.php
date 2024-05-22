
<div class="form-group">
    <label>Image</label>
    <br/>
    <input name="image" type="file" style="display: none;" accept="image/*"/>
    <img id="image-placeholder" src="{{ $category ? $category->image : asset("images/default.png") }}" style="width: 120px;height: 120px"/>
    {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
</div>

<div class="form-group">
    <label for="first_name">category Name</label>
    <input class="form-control"
           name="name"
           type="text" id="name"
           value="{{ old('name', optional($category)->name) }}"
           minlength="1"
           maxlength="255"
           required="true"
           placeholder="Enter Category name" />
        {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
</div>



<div class="form-group">
    <label for="description">Description</label>
    <input class="form-control" name="description" type="text" id="description" value="{{ old('description', optional($category)->description) }}" minlength="1" maxlength="255" required="true" placeholder="Enter email">
    {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
</div>


<div class="form-group">
    <label for="status">Status</label>
    <div class="input-group">
        <select name="status" id="status" class="form-control">
            <option value="">Select Status</option>
            <option value="active" {{ old('status', optional($category)->status) === "active" ? "selected=true":"" }}>Active</option>
            <option value="suspended" {{ old('status', optional($category)->status) === "suspended" ? "selected=true":"" }}>Suspended</option>
        </select>
        {!! $errors->first('status', '<p class="text-danger">:message</p>') !!}
    </div>
</div>

