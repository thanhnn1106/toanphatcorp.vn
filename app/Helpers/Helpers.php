<?php
use Illuminate\Support\Facades\Storage;

function asset_admin($path)
{
    return asset('admin/'.$path);
}
function asset_front($path)
{
    return asset('front/'.$path);
}

function formatMonthYear($string)
{
    if (empty($string)) {
        return '';
    }
    return date('F Y', strtotime($string));
}

function getThumbnail($thumbnail)
{
    if (empty($thumbnail)) {
        return null;
    }

    if (Storage::disk('public')->exists($thumbnail)) {
        return basename($thumbnail);
    }

    return null;
}

function getThumbnailUrl($thumbnail)
{
    if (empty($thumbnail)) {
        return null;
    }

    if (Storage::disk('public')->exists($thumbnail)) {
        return asset(Storage::url($thumbnail));
    }

    return null;
}
