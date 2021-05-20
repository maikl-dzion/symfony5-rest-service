<?php

namespace App\Controller;

use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends AbstractController
{
    protected $jwtStatus = false;
    protected $userId    = 0;
    protected $userRole  = 0;
    protected $request;

    public function __construct() {
        $this->request = Request::createFromGlobals();
    }

    protected function getSecretKey() {
        return 'gfhdgYU546mbnhBN';
    }

    protected function userJwtVerify() {

        $token = $this->request->headers->get('user-jwt-token');
        if(!$token)
            return false;

        $secretKey = $this->getSecretKey();

        try {
            $data = JWT::decode($token, $secretKey, ['HS256']);
            if(!empty($data->user_id)) {
                $this->userId    = $data->user_id;
                $this->userRole  = $data->role;
                $this->jwtStatus = true;
            }

        } catch (\Exception $e) {
            dump($e->getMessage());
        }

        return $this->jwtStatus;
    }
}