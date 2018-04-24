@if(isset($cateTags) && isset($tags))
<ul class="clearfix mb-0">
    @if(isset($cateTags[$fileId]) && count($cateTags[$fileId]))
    <li>
        <span><i class="fas fa-folder-open"></i></span>
        <?php $iCate = 0; ?>
        @foreach($cateTags[$fileId] as $cate)
        <?php $iCate++; ?>
        <a href="{{ route('front.category_detail', ['slug' => $cate['slug']]) }}">{{ $cate['name'] }}</a>@if($iCate < count($cateTags[$fileId])),@endif
        @endforeach
    </li>
    @endif

    @if(isset($fileId) && isset($tags[$fileId]) && count($tags[$fileId]))
    <li>
        <span><i class="fas fa-tag"></i></span>
        <?php $iTag = 0; ?>
        @foreach($tags[$fileId] as $tag)
        <?php $iTag++; ?>
        <a href="{{ route('front.tag_detail', ['slug' => $tag['slug']]) }}">{{ $tag['name'] }}</a>@if($iTag < count($tags[$fileId])),@endif
        @endforeach
    </li>
    @endif
</ul>
@endif