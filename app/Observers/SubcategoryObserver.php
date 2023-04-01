<?php

namespace App\Observers;

use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;

class SubcategoryObserver
{

    public function deleting(Subcategory $subcategory)
    {
        Storage::disk('public')->delete($subcategory->url);
    }
     
}
