<?php
namespace App\Services;

use App\Repositories\PrefectureRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PrefectureService
{
    public function __construct(
        public PrefectureRepository $prefectureRepository,
    ) {
    }

    public function getAllPrefectures(): Collection
    {
        try {
            return $this->prefectureRepository->getAllPrefectures();
        } catch (Exception $e) {
            throw new Exception('Error fetching prefectures: ' . $e->getMessage());
        }
    }

    public function getPrefectureByName(string $name)
    {
        try {
            return $this->prefectureRepository->getPrefectureByName($name);
        }  catch (Exception $e) {
            throw new Exception('Error fetching prefecture by name: ' . $e->getMessage());
        }
    }
}
