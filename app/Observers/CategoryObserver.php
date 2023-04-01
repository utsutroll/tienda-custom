<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryObserver
{
    
    public function deleting(Category $category)
    {
        Storage::disk('public')->delete($category->url);
    }
}
