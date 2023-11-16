<?php

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

function formatDate($date, $format = 'M d, Y h:i A'): ?string
{
    if ($date != null) {
        return Carbon\Carbon::parse($date)->format($format);
    }
    return null;
}


function unlinkFile($file_name, $path): bool
{
    $uploadPath = storage_path('app/public/' . $path . '/');
    $imagePath = $uploadPath . $file_name;
    @unlink($imagePath);
    return true;
}


function getFileUrl($file_name, $path)
{
    if($path == 'unit/media'){
        if (!Auth::check()) {
            return redirect('/login');
        }
        $media_path = 'storage/' . $path . '/' . $file_name;
        return route('protected.media', $file_name);
    }
    return url('storage/' . $path . '/' . $file_name);
}

