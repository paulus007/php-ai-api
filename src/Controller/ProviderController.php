<?php

namespace App\Controller;

use App\Service\ProviderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ProviderController extends AbstractController
{
    public function __construct(
        private readonly ProviderService $providerService,
    ) {
    }

    #[Route('/provider/{id}', methods: [Request::METHOD_GET])]
    public function getProvider(int $id): JsonResponse
    {
        return new JsonResponse($this->providerService->getProvider($id));
    }

    #[Route('/providers/{offset}/{limit}/{search}', methods: [Request::METHOD_GET])]
    public function getProviders(int $offset = 0, int $limit = 0, string $search = ''): JsonResponse
    {
        return new JsonResponse($this->providerService->getProviders($offset, $limit, $search));
    }

    #[Route('/provider/post', methods: [Request::METHOD_POST])]
    public function postProvider(Request $request): JsonResponse
    {
        return new JsonResponse($this->providerService->postProvider($request->toArray()));
    }

    #[Route('/provider/put/{id}', methods: [Request::METHOD_PUT])]
    public function putProvider(Request $request, int $id): JsonResponse
    {
        return new JsonResponse($this->providerService->putProvider($request->toArray(), $id));
    }

    #[Route('/provider/patch/{id}', methods: [Request::METHOD_PATCH])]
    public function patchProvider(Request $request, int $id): JsonResponse
    {
        return new JsonResponse($this->providerService->patchProvider($request->toArray(), $id));
    }

    #[Route('/provider/delete/{id}', methods: [Request::METHOD_DELETE])]
    public function deleteProvider(int $id): JsonResponse
    {
        return new JsonResponse($this->providerService->deleteProvider($id));
    }
}
