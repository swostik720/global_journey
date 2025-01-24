@props([
    'url' => null,
    'name' => $name,
    'height' => '300px',
    'width' => '300px',
    'default_url' => 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg',
])
<td>
    <a href="@if (isset($name, $url) && $url !== '' && $name !== '') {{ $url }}@else{{ $default_url }} @endif" target="_blank">
        <img src="@if (isset($name, $url) && $url !== '' && $name !== '') {{ $url }}@else{{ $default_url }} @endif" alt="title"
            height="{{ $height }}" width="{{ $width }}" {{ $attributes }}>
    </a>
</td>
