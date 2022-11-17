<?php

namespace App\Transformers\Tiket;

use App\Transformers\BaseTransformer;

class TiketTransformer extends BaseTransformer
{
    /**
     * {@inheritdoc}
     */
    public function getResourceKey(): string
    {
        return 'tiket';
    }

    /**
     * transform.
     *
     * @param $tiket
     *
     * @return array
     */
    public function transform($tiket)
    {
        return [
            'id' => $tiket->id,
            'nama'       => $tiket->nama,
            'nohp'      => $tiket->nohp,
            'tglberangkat' => $tiket->tglberangkat,
            'kelasarmada' => $tiket->kelasarmada,
            'kotatujuan' => $tiket->kotatujuan,
            'tiket' => $tiket->tiket,
            'status'      => [
                'status_id'   => $tiket->status_id,
                'status_name' => $tiket->status,
            ],
            'created_at'  => $tiket->created_at,
            'updated_at'  => $tiket->updated_at,
        ];
    }
}
