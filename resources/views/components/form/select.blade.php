@props([
  'id' => $name,
  'label' => 'Select',
  'class' => 'form-control',
  'value' => '',
  'type' => 'text',
  'message' => '',
  'col' => '12',
  'req' => false,
  'labelDisplay' => true,
  'optionDisplay' => true,
  'model' => null,
  '_key' => null,
  'name',
  'options'
])

@php
    $selectedValue = old($name);

    if ($selectedValue === null || $selectedValue === '') {
        if (isset($model)) {
            $selectedValue = $model;
        } elseif ($value !== '') {
            $selectedValue = $value;
        }
    }

    $hasSelectedValue = !($selectedValue === null || $selectedValue === '');
@endphp

<div class="col-md-{{$col}}">

    @if($labelDisplay === true)
        <label for="{{$id}}" class="col-form-label">{{$label}} @if($req === true)
                <span class="text-danger">*</span>
            @endif</label>
    @endif
    <select name='{{$name}}' id="{{$id}}" {{ $attributes->merge(['class' => $class . ' form-control']) }}>
        @if($optionDisplay === true)
            <option value="" disabled {{ $hasSelectedValue ? '' : 'selected' }}>Select {{$label}}</option>
        @endif

        {{$slot}}

        @foreach($options as $key => $item)
            @php
                $optionValue = (string) $key;
                $isSelected = false;

                if ($hasSelectedValue) {
                    $selectedAsString = (string) $selectedValue;
                    $itemAsString = is_scalar($item) ? (string) $item : '';
                    $isSelected = $selectedAsString === $optionValue || ($itemAsString !== '' && $selectedAsString === $itemAsString);
                } elseif (isset($_key) && $key == 1) {
                    $isSelected = true;
                }
            @endphp
            <option value='{{ $key }}' {{ $isSelected ? 'selected' : '' }}>{{ $item }}</option>
        @endforeach
    </select>
    @error($name)
        <span class="text-danger small">{{ $message !== '' ? $message : $errors->first($name) }}</span>
    @enderror
</div>
