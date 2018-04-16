@if( ! empty($categories))
<div class="inner clearfix">
    <div class="container">
        <p class="title_01">Categories</p>
        <div id="slider_02">
            @foreach ($categories as $category)
            <div class="item">
                <div class="item_content">
                    <?php 
                        $thumbnailUrl = getThumbnailUrl($category['thumbnail']);
                    ?>
                    @if( ! empty($thumbnailUrl))
                    <p class="item_img">
                        <img src="{{ $thumbnailUrl }}" alt="img">
                    </p>
                    @endif
                    <p class="item_ct">
                        <span>{{ $category['name'] }}</span>
                        <span>{{ formatMonthYear($category['created_at']) }}</span>
                        <a href="{{ route('front.category_detail', ['slug' => $category['slug']]) }}" class="btn btn_03">read more</a>
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif