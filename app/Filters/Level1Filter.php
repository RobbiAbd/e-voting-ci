<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Level1Filter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = NULL)
    {
        if (!(session()->get('id_level') == 1 || session()->get('id_level') == 2)) {
            session()->setFlashdata('danger', 'Tidak punya akses');
            return redirect()->route('admin');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
        // Do something here
    }
}
