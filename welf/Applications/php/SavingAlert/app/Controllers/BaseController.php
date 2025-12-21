<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Session\Session;
use Psr\Log\LoggerInterface;

class BaseController extends Controller
{
    /**
     * Session instance
     */
    protected Session $session;

    /**
     * Helpers that will be loaded automatically
     */
    protected $helpers = [
        'url',
        'form',
        'auth',
        'user',
        'donation',
        'notification'// your custom helper
    ];

    /**
     * Initialize controller
     */
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Load session once for all controllers
        $this->session = service('session');
    }
}
