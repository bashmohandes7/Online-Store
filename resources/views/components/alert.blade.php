@props([
    'type', 'alert'=>'success',
])

@if(session()->has($type))
<div class="alert alert-{{ $alert}}">
    {{ session($type) }}
</div>
@endif
