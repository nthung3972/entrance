<?php

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Prefecture;
use App\Repositories\PrefectureRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PrefectureService
{
    public function __construct(
        public PrefectureRepository $prefectureRepository,
    ) {}

    public function getAllPrefectures(): Collection
    {
        return $this->prefectureRepository->getAllPrefectures();
    }

    public function getPrefectureByName(string $name): ?Prefecture
    {
        return $this->prefectureRepository->getPrefectureByName($name);
    }
}
