<?php

namespace App\Models;

use App\Entities\TiketEntity;
use CodeIgniter\Model;

class TiketModel extends Model
{
    protected $table = 'tiket';
    protected $primaryKey = 'id';
    protected $returnType = TiketEntity::class;
    protected $useSoftDeletes = true;
    protected $allowedFields = ['nama', 'nohp', 'tglberangkat', 'kelasarmada', 'kotatujuan', 'tiket',
    'status_id'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'status_id'   => 'required|numeric',
        'nama' => 'required|min_length[10]|max_length[200]',
        'nohp' => 'required',
        'tglberangkat' => 'required',
        'kelasarmada' => 'required',
        'kotatujuan' => 'required',
        'tiket' => 'required|numeric',
        // 'description' => 'required|min_length[10]|max_length[200]',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;

    const ORDERABLE = [
        1 => 'nama',
        2 => 'nohp',
        3 => 'tglberangkat',
        4 => 'kelasarmada',
        5 => 'kotatujuan',
        6 => 'tiket',
        7 => 'status',
    ];

    public $orderable = ['nama', 'nohp', 'tglberangkat', 'kelasarmada', 'kotatujuan', 'tiket', 'status'];

    /**
     * Get resource data.
     *
     * @param string $search
     *
     * @return \CodeIgniter\Database\BaseBuilder
     */
    public function getResource(string $search = '')
    {
        $builder = $this->builder()
            ->select('tiket.id, tiket.nama, tiket.nohp, tiket.tglberangkat, tiket.kelasarmada, tiket.kotatujuan,
            tiket.tiket, tiket.created_at, status.status')
            ->join('status', 'tiket.status_id = status.id');

        $condition = empty($search)
            ? $builder
            : $builder->groupStart()
                ->like('nama', $search)
                ->orLike('nohp', $search)
                ->orLike('tglberangkat', $search)
                ->orLike('kelasarmada', $search)
                ->orLike('kotatujuan', $search)
                ->orLike('tiket', $search)
                ->orLike('status', $search)
            ->groupEnd();

        return $condition->where([
            'tiket.deleted_at'  => null,
            'status.deleted_at' => null,
        ]);
    }
}
