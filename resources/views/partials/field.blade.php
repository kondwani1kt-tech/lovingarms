@php
    $type = $type ?? 'text';
    $required = $required ?? false;
    $current = old($name, $value ?? '');
    $hasError = $errors->has($name);
@endphp
<div class="field {{ ($full ?? false) ? 'full' : '' }}">
    <label for="f_{{ $name }}">{{ $label }}{{ $required ? ' *' : '' }}</label>
    @if($type === 'select')
        <select id="f_{{ $name }}" name="{{ $name }}" @required($required) @if(($autocomplete ?? null)) autocomplete="{{ $autocomplete }}" @endif @if($hasError) aria-invalid="true" aria-describedby="f_{{ $name }}_error" @endif>
            <option value="">{{ $blank ?? 'Choose one' }}</option>
            @foreach($options as $v => $l)
                <option value="{{ $v }}" @selected((string) $current === (string) $v)>{{ $l }}</option>
            @endforeach
        </select>
    @elseif($type === 'textarea')
        <textarea id="f_{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" @required($required) @if(($autocomplete ?? null)) autocomplete="{{ $autocomplete }}" @endif @if($hasError) aria-invalid="true" aria-describedby="f_{{ $name }}_error" @endif>{{ $current }}</textarea>
    @elseif($type === 'file')
        <input id="f_{{ $name }}" name="{{ $name }}" type="file" @required($required) @if(($autocomplete ?? null)) autocomplete="{{ $autocomplete }}" @endif @if(($accept ?? null)) accept="{{ $accept }}" @endif @if($hasError) aria-invalid="true" aria-describedby="f_{{ $name }}_error" @endif>
    @else
        <input id="f_{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ $current }}" placeholder="{{ $placeholder ?? '' }}" @required($required) @if(($autocomplete ?? null)) autocomplete="{{ $autocomplete }}" @endif @if(($accept ?? null)) accept="{{ $accept }}" @endif @if($hasError) aria-invalid="true" aria-describedby="f_{{ $name }}_error" @endif>
    @endif
    @error($name)<span id="f_{{ $name }}_error" class="err" role="alert">{{ $message }}</span>@enderror
</div>
