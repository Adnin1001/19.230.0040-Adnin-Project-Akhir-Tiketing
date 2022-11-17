<?php

namespace App\Controllers;

use App\Models\Tiket;

class Home extends BaseController
{
    public function index()
    {
        return view('TiketView');
    }

    //--------------------------------------------------------------------

    public function eloquent()
    {
        service('eloquent');

        return $this->response->setJSON(Tiket::paginate());
    }
}
