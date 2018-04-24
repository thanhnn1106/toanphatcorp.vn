@if(Auth::check() && ! empty($file))
    @if($file->isNormalDownload())
        <a href="javascript:void(0);" onclick="fncDownload(this);" data-id="{{ $file->id }}" class="btn btn_03">Cloud</a>
    @endif
@else
<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" class="btn btn_03">download</a>
@endif