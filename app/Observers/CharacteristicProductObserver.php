<?php

namespace App\Observers;

use App\Models\CharacteristicProduct;
use Illuminate\Support\Facades\Storage;

class CharacteristicProductObserver
{
    public function deleting(CharacteristicProduct $characteristicproduct)
    {
        if ($characteristicproduct->image) 
        {
            Storage::delete($characteristicproduct->image);
        }
    }
}

