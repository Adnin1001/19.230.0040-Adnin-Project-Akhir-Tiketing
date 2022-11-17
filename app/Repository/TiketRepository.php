<?php

namespace App\Repository;

use App\Models\TiketModel;
use Fluent\Repository\Eloquent\BaseRepository;

class TiketRepository extends BaseRepository
{
    protected $searchable = [
        'nama' => 'like',
        'nohp' => 'orLike',
        'tglberangkat' => 'orLike',
        'kelasarmada' => 'orLike',
        'kotatujuan' => 'orLike',
        'tiket' => 'orLike',
        'status'      => 'orLike',
    ];

    public function entity()
    {
        return new TiketModel();
    }
}
