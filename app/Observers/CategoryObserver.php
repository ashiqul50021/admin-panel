<?php

namespace App\Observers;

use App\Models\Category;
use App\Repository\LogRepository;
use Illuminate\Support\Facades\Storage;

class CategoryObserver
{
    public function deleting(Category $category)
    {
        //Get original Publisher information
        $original = $category->getOriginal();
        $oldImage = basename($original["image"]);
        //Delete the Advertiser image
        if ($oldImage != 'default.png') {
            Storage::delete(config('system.upload_path') . "/" . $oldImage);
        }
    }

    public function updating(Category $category)
    {
        //Get the original publisher information
        $original = $category->getOriginal();
        $oldImage = basename($original["image"]);
        $newImage = basename($category->image);
        //if image was updated then change the image
        if (isset($newImage) && $newImage != $oldImage && $oldImage != 'default.png') {
            Storage::delete(config('system.upload_path') . "/" . $oldImage);
        }
    }

    public function created(Category $category): void
    {
        LogRepository::instance()->create("category-created", "{$category->name} has been created!");
    }

    public function updated(Category $category): void
    {
        LogRepository::instance()->create("category-updated", "{$category->name} has been updated!");
    }

    public function deleted(Category $category): void
    {
        LogRepository::instance()->create("category-deleted", "{$category->name} has been deleted!");
    }
}
