@if(Auth::check() && ! empty($file))
    @if($file->isNormalDownload())
        <a href="javascript:void(0);" onclick="fncDownload(this);" data-url="{{ route('front.files_download') }}" data-id="{{ $file->id }}" class="btn btn_03">Cloud</a>
    @elseif ($file->isPremiumDownload() && $user->isAccessDownload() && $file->isMaxDownload())
        <a href="javascript:void(0);" onclick="fncDownload(this);" data-url="{{ route('front.files_preimum_download') }}" data-id="{{ $file->id }}" class="btn btn_03">Cloud</a>
    @endif
@else
<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" class="btn btn_03">download</a>
@endif