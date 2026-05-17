@props([
  'id' => $name,
  'label' => 'Select',
  'class' => 'form-control text-14',
  'value' => '',
  'type' => 'text',
  'message' => '',
  'col' => '12',
  'req' => false,
  'model' => null,
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

    <label for="{{$id}}" class="col-form-label">{{$label}} @if($req === true)
            <span class="text-danger">*</span>
        @endif</label>
{{-- @dd($model->value); --}}
    <select name='{{$name}}' class="form-control" id="{{$id}}">
        <option value="" disabled {{ $hasSelectedValue ? '' : 'selected' }}> Select {{$label}} </option>
        @foreach($options as $item)
            @php
                $isSelected = $hasSelectedValue && (string) $selectedValue === (string) $item->value;
            @endphp
            <option value='{{ $item->value }}' {{ $isSelected ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach

    </select>
    @error($name)
        <span class="text-danger small">{{ $message !== '' ? $message : $errors->first($name) }}</span>
    @enderror
</div>
