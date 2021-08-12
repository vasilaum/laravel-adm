@foreach ($extraFields as $field)

    @if (in_array($field->type, ['number', 'text', 'date', 'email']))
        <div class="form-group">
            <label>{{ $field->label }}</label>
            <input type="{{ $field->type }}" id="{{ $field->field_id }}" name="EX__{{ $field->name }}" placeholder="{{ $field->placeholder }}" value="{{ $field->value }}" class="form-control" />
        </div>
    @else

        @switch($field->type)
            @case('textarea')
                <div class="form-group">
                    <label>{{ $field->label }}</label>
                    <textarea name="EX__{{ $field->name }}" id="{{ $field->field_id }}" placeholder="{{ $field->placeholder }}" class="form-control">{{ $field->value }}</textarea>
                </div>
            @break

            @case('select')
                <div class="form-group">
                    <label>{{ $field->label }}</label>
                    <select name="EX__{{ $field->name }}" id="{{ $field->field_id }}" class="form-control">
                        @foreach ($field->options as $option)
                            <option
                                {{ $option->value == $field->value ? 'selected' : '' /* selected */ }}
                                value="{{ $option->value }}"
                            >
                                {{ $option->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @break

            @case('radio')
                <label>{{ $field->label }}</label>
                @foreach ($field->options as $option)
                    <div class="form-check">
                        <input
                            type="radio"
                            name="EX__{{ $field->name }}"
                            id="{{ $field->field_id }}"
                            value="{{ $option->value }}"
                            class="form-check-input"
                            {{ $option->value == $field->value ? 'checked' : '' /* checked */ }}
                        />
                        <label class="form-check-label">
                            {{ $option->name }}
                        </label>
                    </div>
                @endforeach
            @break

            @case('checkbox')
                <label>{{ $field->label }}</label>
                @foreach ($field->options as $option)
                    <div class="form-check">
                        <input
                            type="checkbox"
                            name="EX__{{ $field->name }}[]"
                            id="{{ $field->field_id }}"
                            value="{{ $option->value }}"
                            class="form-check-input"
                                @php
                                    $jsonFieldValue = json_decode($field->value)
                                @endphp

                                @if (is_array($jsonFieldValue))
                                    {{ in_array($option->value, $jsonFieldValue) ? 'checked' : '' /* checked */ }}
                                @else
                                    {{ $option->value == $field->value ? 'checked' : '' /* checked */ }}
                                @endif
                        />
                        <label class="form-check-label">
                            {{ $option->name }}
                        </label>
                    </div>
                @endforeach
            @break

            @default
                <label>{{ $field->label }}</label>
                <input type="{{ $field->type }}" id="{{ $field->field_id }}" name="EX__{{ $field->name }}" placeholder="{{ $field->placeholder }}" />
            @break
        @endswitch

    @endif

@endforeach