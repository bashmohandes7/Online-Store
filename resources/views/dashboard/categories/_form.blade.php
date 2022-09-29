@if ($errors->any())
    <div class="alert alert-danger">
        <h3>Error Occured!</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div> {{-- End of errors --}}
@endif


<div class="form-group">
    <label for="name">Category Name</label>
    <x-form.input type="text" name="name" :value="$category->name" />
</div>

<div class="form-group">
    <label for="description">Category Description</label>
    <x-form.input type="text" name="description" :value="$category->description" :value="$category->description" />
</div>

<div class="form-group">
    <label for="">Category Parent</label>

    <x-form.select name="parent_id" :options="$parents" :value="$category->id" />

</div>

<div class="form-group">
    <label>Image</label>
    <input type="file" name="image" @class([
        'form-control',
        'image',
        'is-invalid' => $errors->has('image'),
    ])>
    @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <img src="{{ $category->image_path }}" style="width: 100px" @class(['img-thumbnail', 'image-preview']) alt="">
</div>

<div class="form-group">
    <label for="">Status</label>
    <select name="status" @class([
        'form-control',
        'form-select',
        'is-invalid' => $errors->has('status'),
    ])>
        <option value="active" @selected(old('status', $category->status) == 'active')>Active</option>
        <option value="archived" @selected(old('status', $category->status) == 'archived')>Archived</option>
    </select>

    @error('status')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>

<div class="form-group">
    <input type="submit" value="{{ $btn_label ?? 'Save' }}" @class(['btn', 'btn-md', 'btn-outline-primary'])>
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            // image preview
            $(".image").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.image-preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }); //end of ready
    </script>
@endpush
