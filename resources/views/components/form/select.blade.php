@props(['name', 'options' => [], 'value'])


<select name="{{ $name }}"
    {{ $attributes->class(['form-control', 'form-select', 'is-invalid' => $errors->has($name)]) }}>
    <option value="">Primary Category</option>
    @foreach ($options as $option)
        <option value="{{ $option->id }}" @selected(old($option->id, $value) == $value)>{{ $option->name }}</option>
    @endforeach
</select>
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
