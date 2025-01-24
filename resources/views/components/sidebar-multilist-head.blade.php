@props([
  'icon' => 'bx bx-home-circle',
  'name' => 'Multi Sidebar',
])

<li class="menu-item" style="">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons {{$icon}}"></i>
        <div class="text-truncate" data-i18n="{{$name}}">{{$name}}</div>
    </a>
    <ul class="menu-sub">
        {{$slot}}
    </ul>
</li>
