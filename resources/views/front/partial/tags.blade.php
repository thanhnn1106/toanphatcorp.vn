<ul class="clearfix mb-0">
    <li>
        <span><i class="fas fa-folder-open"></i></span>
        <a href="">80s</a>, 
        <a href="">90s</a>, 
        <a href="">and</a>, 
        <a href="">Pack</a>, 
        <a href="">redrum</a>
    </li>

    @if(isset($fileId) && isset($tags[$fileId]) && count($tags[$fileId]))
    <li>
        <span><i class="fas fa-tag"></i></span>
        <?php $iTag = 0; ?>
        @foreach($tags[$fileId] as $tag)
        <?php $iTag++; ?>
        <a href="{{ route('front.tag_detail', ['slug' => $tag['slug']]) }}">{{ $tag['name'] }}</a>
        @if($iTag < count($tags[$fileId]))
        , 
        @endif
        @endforeach
    </li>
    @endif
</ul>