<?php

namespace App\Controller;

use App\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index', methods: [Request::METHOD_GET])]
    public function index(): Response
    {
        return new Response('<h1>Welcome to PHP AI Proxy</h1>');
    }

    #[Route('/list', name: 'list', methods: [Request::METHOD_GET])]
    public function list(): Response
    {
        return new JsonResponse(['list' => []]);
    }
}
