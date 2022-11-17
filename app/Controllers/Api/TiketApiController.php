<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Criteria\TiketCriteria;
use App\Models\TiketModel;
use App\Repository\TiketRepository;
use App\Transformers\Tiket\TiketTransformer;
use CodeIgniter\Config\Config;

class TiketApiController extends BaseController
{
    protected $tiket;
    protected $pager;

    public function __construct()
    {
        $this->tiket = new TiketRepository();
        $this->pager = Config::get('Pager')->perPage;
    }

    /**
     * index.
     *
     * @return \CodeIgniter\Http\Response
     */
    public function index()
    {
        $resource = $this->tiket->scope($this->request)
            ->withCriteria([new TiketCriteria()])
            ->paginate(null, static::withSelect());

        return $this->fractalCollection($resource, new TiketTransformer());
    }

    /**
     * show.
     *
     * @return \CodeIgniter\Http\Response
     */
    public function show($id = null)
    {
        $resource = $this->tiket->withCriteria([new TiketCriteria()])->find($id, static::withSelect());

        if (is_null($resource)) {
            return $this->failNotFound(sprintf('tiket with id %d not found', $id));
        }

        return $this->fractalItem($resource, new TiketTransformer());
    }

    /**
     * create.
     *
     * @return \CodeIgniter\Http\Response
     */
    public function create()
    {
        $request = $this->request->getPost(null, FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$this->validate(static::rules())) {
            return $this->fail($this->validator->getErrors());
        }

        try {
            $resource = $this->tiket->create($request);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }

        return $this->respondCreated($resource);
    }

    /**
     * edit.
     *
     * @param int $id
     *
     * @return CodeIgniter\Http\Response
     */
    public function edit($id = null)
    {
        return $this->show($id);
    }

    /**
     * update.
     *
     * @param int $id
     *
     * @return CodeIgniter\Http\Response
     */
    public function update($id = null)
    {
        $request = $this->request->getRawInput();

        if (!$this->validate(static::rules())) {
            return $this->fail($this->validator->getErrors());
        }

        try {
            $this->tiket->update($request, $id);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }

        return $this->respondUpdated(['id' => $id], "tiket id {$id} updated");
    }

    /**
     * delete.
     *
     * @param int $id
     *
     * @return CodeIgniter\Http\Response
     */
    public function delete($id = null)
    {
        $this->tiket->destroy($id);

        if ((new TiketModel())->db->affectedRows() === 0) {
            return $this->failNotFound(sprintf('tiket with id %d not found or already deleted', $id));
        }

        return $this->respondDeleted(['id' => $id], "tiket id {$id} deleted");
    }

    /**
     * With select.
     *
     * @return array
     */
    protected static function withSelect()
    {
        return [
            'tiket.id', 'tiket.status_id', 'tiket.nama', 'tiket.nohp', 'status.tglberangkat', 'tiket.kelasarmada',
            'tiket.kotatujuan', 'tiket.tiket', 'tiket.created_at', 'tiket.updated_at',
        ];
    }

    /**
     * Rules set.
     *
     * @return array
     */
    protected static function rules()
    {
        return [
            'status_id'   => 'required|numeric',
            'nama' => 'required|min_length[10]|max_length[200]',
            'nohp' => 'required',
            'tglberangkat' => 'required',
            'kelasarmada' => 'required',
            'kotatujuan' => 'required',
            'tiket' => 'required|numeric',
        ];
    }
}
