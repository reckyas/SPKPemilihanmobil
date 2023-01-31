<div class="mb-2">
    <label for="{{ $name }}">
        <span class="text-slate-700 font-semibold">{{ $label }}</span>
        <input type="{{ $type }}"
            id="{{ $name }}"
            class="px-3 py-2 border-2 border-slate-500 mt-1 rounded-lg outline-none focus:ring-2 focus:ring-blue-400 text-slate-700 font-semibold w-full disabled:bg-slate-200 disabled:text-slate-500 disabled:cursor-not-allowed"
            name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}"
            @if ($required) required @endif
            @if ($value) value="{{ $value }}" @else value="{{ old($name) }}" @endif
            @if ($disable) disabled @endif>
        @if ($error)
            <p>{{ $error['nama'] }}</p>
        @endif
    </label>
</div>
