<?php

namespace App\Repositories;

use App\Models\Prefecture;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PrefectureRepository {
    public function getAllPrefectures(): Collection {
        return Prefecture::all();
    }

    public function getPrefectureByName(string $name): Prefecture 
    {
        return Prefecture::where('prefecture_name_alpha', $name)->first();
    }
}
