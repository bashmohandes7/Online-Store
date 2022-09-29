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
    <label for="name">Products Name</label>
    <x-form.input type="text" name="name" :value="$product->name" />
</div>

<div class="form-group">
    <label for="description">Products Description</label>
    <x-form.input type="text" name="description" :value="$product->description" />
</div>
<div class="form-group">
    <label for="price">Product Price</label>
    <x-form.input type="text" name="price" :value="$product->price" />
</div>
<div class="form-group">
    <label for="compare_price">Compare Price</label>
    <x-form.input type="text" name="compare_price" :value="$product->compare_price" />
</div>

<div class="form-group">
    <label for="">Category</label>

    <x-form.select name="category_id" :options="$categories" :value="$product->id" />

</div>

<div class="form-group">
    <label for="compare_price">Tags</label>
    <x-form.input type="text" name="tags"  :value="$tags" />
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
    <img src="{{ $product->image_path }}" style="width: 100px" @class(['img-thumbnail', 'image-preview']) alt="">
</div>

<div class="form-group">
    <label for="">Status</label>
    <select name="status" @class([
        'form-control',
        'form-select',
        'is-invalid' => $errors->has('status'),
    ])>
        <option value="active" @selected(old('status', $product->status) == 'active')>Active</option>
        <option value="archived" @selected(old('status', $product->status) == 'archived')>Archived</option>
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

@push('styles')
<link href="{{ asset('dashboard/dist/css/tagify.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
<script src="{{ asset('dashboard/dist/js/tagify.min.js') }}"></script>
<script src="{{ asset('dashboard/dist/js/tagify.polyfills.min.js') }}"></script>
<script>
    var inputElm = document.querySelector('[name=tags]'),
    tagify = new Tagify (inputElm);
</script>
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
