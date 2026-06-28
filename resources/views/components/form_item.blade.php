<div class="form-group  flex flex-col gap-1 text-black font-semibold w-full">
    <label class="text-sm">
        {{ $label }}
    </label>
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        class="bg-primary/20 px-5 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50 w-full mb-1"
        value="{{ old($name) }}"
        required
    />
    @error($name)
        <p class="text-ditolak text-sm">
            {{ $message }}
        </p>
    @enderror
    {{ $slot }}
</div>