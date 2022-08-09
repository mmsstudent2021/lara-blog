<div class="mb-3">
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    <input
        type="{{ $type }}"
        value="{{ old($name,$default) }}"
        class="form-control @error($name) is-invalid @enderror @error("$name.*") is-invalid @enderror"
        name="{{ $multiple ? $name."[]" : $name }}"
        id="{{ $name }}"
        @isset($multiple) multiple @endisset
    >
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @isset($multiple)
        @error("$name.*")
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    @endisset
</div>
