@if( ! empty($categories))
<dl class="frm_cate">
    <dt>category</dt>
    <dd>
        <ul class="clearfix">
            @foreach($categories as $c)
            <li>
                <a href="{{ route('front.category_detail', ['slug' => $c['slug']]) }}"
                   class="@if (isset($category['id']) && $category['id'] == $c['id'])) cate_rm @endif"
                >
                    {{ $c['name'] }}
                </a>
            </li>
            @endforeach
        </ul>
    </dd>
</dl>
@endif