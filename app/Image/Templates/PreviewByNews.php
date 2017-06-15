<?php namespace App\Image\Templates;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class PreviewByNews implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(780, null, function($constraint) {
          $constraint->aspectRatio();
        });
    }
}