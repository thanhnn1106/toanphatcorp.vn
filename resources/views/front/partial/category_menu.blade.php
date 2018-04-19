@if( ! empty($categories))
<dl class="frm_cate">
    <dt>category</dt>
    <dd>
        <ul class="clearfix">
            @foreach($categories as $category)
            <li><a href="{{ route('front.cate_detail', ['slug' => $category['slug']]) }}">{{ $category['name'] }}</a></li>
            @endforeach
        </ul>
    </dd>
</dl>
@endif