<div class="mb-2">
    <label for="{{ $name }}">
        <span class="text-slate-700 font-semibold">{{ $label }}</span>
        <select name="{{ $name }}" id="{{ $name }}" @if ($required) required @endif
            class="px-3 py-2 border-2 border-slate-500 mt-1 rounded-lg outline-none focus:ring-2 focus:ring-blue-400 text-slate-700 font-semibold w-full">
            @foreach ($options as $option)
                @if ($selected && $selected == $option['value'])
                    <option value="{{ $option['value'] }}" selected>{{ $option['label'] }}</option>
                @elseif (old($name) == $option['value'])
                    <option value="{{ $option['value'] }}" selected>{{ $option['label'] }}</option>
                @else
                    <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                @endif
            @endforeach
        </select>
    </label>
</div>
