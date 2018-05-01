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

function formatDayMonthYear($string)
{
    if (empty($string)) {
        return '';
    }
    return date('F dS , Y', strtotime($string));
}

function getThumbnail($thumbnail)
{
    $imagePath = getImage($thumbnail);
    return getDefaultImage($imagePath, false, true);
}

function getThumbnailUrl($thumbnail)
{
    $imagePath = getImage($thumbnail, true);
    return getDefaultImage($imagePath, true, true);
}

function getCoverImage($coverImage)
{
    $imagePath = getImage($coverImage);
    return getDefaultImage($imagePath, false);
}

function getCoverImageUrl($coverImage)
{
    $imagePath = getImage($coverImage, true);
    return getDefaultImage($imagePath, true);
}

function getDefaultImage($imagePath, $isUrl = false, $isThumb = false)
{
    if (empty($imagePath)) {
        $coverDefault = 'front/images/cate_cover_default.jpg';
        $thumbDefault = 'front/images/cate_thumb_default.jpg';

        $defaultImage = $coverDefault;
        if ($isThumb) {
            $defaultImage = $thumbDefault;
        }

        if ($isUrl) {
            return asset($defaultImage);
        }
        return basename($defaultImage);
    }

    return $imagePath;
}

function getImage($imagePath, $isUrl = false)
{
    if (empty($imagePath)) {
        return null;
    }

    if (Storage::disk('public')->exists($imagePath)) {
        if ($isUrl) {
            return asset(Storage::url($imagePath));
        }
        return basename($imagePath);
    }

    return null;
}

function formatCurrency($number)
{
    return number_format($number, 0, ',', '.');
}
