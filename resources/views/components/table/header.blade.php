{{-- <thead class="bg-primary">
<tr class="text-uppercase">
    <th class="text-white" style="width:50px">#</th>
    @foreach ($headers as $key => $header)
        <th class="text-white" @if ($key !== 0) style="width:{{$key}}" @endif>{{$header}}</th>
    @endforeach
</tr>
</thead> --}}

<thead class="bg-primary">
    <tr class="text-uppercase">
        <th class="text-white" style="width:50px"><input type="checkbox" id="select-all"> All</th>
        @foreach ($headers as $header)
            <th class="text-white">{{ $header }}</th>
        @endforeach
    </tr>
</thead>
