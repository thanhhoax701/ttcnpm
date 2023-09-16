<ol class="breadcrumb ">
    @if(mb_strtolower($title)!='trang chủ')
        <li class="breadcrumb-item"><a href="{{route('home')}}">Trang Chủ</a></li>
        @foreach($breadcrumbs as $key =>$breadcrumb)
            <li class="breadcrumb-item {{($key+1==count($breadcrumbs))?'active':''}}"><a href="{{$breadcrumb['link']}}">{{$breadcrumb['name']}}</a></li>
        @endforeach
    @else
        <li class="breadcrumb-item"><a href="{{route('home')}}">Trang Chủ</a></li>
    @endif
</ol>