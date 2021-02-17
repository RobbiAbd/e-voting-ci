<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class TokenFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = NULL)
    {
        if (!session()->has('token_key')) {
            session()->setFlashdata('danger', 'Silahkan masukan token terlebih dahulu');
            return redirect()->route('voting');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
        // Do something here
    }
}
