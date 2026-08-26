<?php

namespace App\Controller;

use App\Service\TemplateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class TemplateController extends AbstractController
{
    public function __construct(
        private readonly TemplateService $templateService,
    ) {
    }

    #[Route('/template/{id}', methods: [Request::METHOD_GET])]
    public function getTemplate(int $id): JsonResponse
    {
        return new JsonResponse($this->templateService->getTemplate($id));
    }

    #[Route('/templates/{offset}/{limit}/{search}', methods: [Request::METHOD_GET])]
    public function getTemplates(int $offset = 0, int $limit = 0, string $search = ''): JsonResponse
    {
        return new JsonResponse($this->templateService->getTemplates($offset, $limit, $search));
    }

    #[Route('/template/post', methods: [Request::METHOD_POST])]
    public function postTemplate(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->templateService->postTemplate($request->toArray())
        );
    }

    #[Route('/template/put/{id}', methods: [Request::METHOD_PUT])]
    public function putTemplate(Request $request, int $id): JsonResponse
    {
        return new JsonResponse($this->templateService->putTemplate($request->toArray(), $id));
    }

    #[Route('/template/patch/{id}', methods: [Request::METHOD_PATCH])]
    public function patchTemplate(Request $request, int $id): JsonResponse
    {
        return new JsonResponse($this->templateService->patchTemplate($request->toArray(), $id));
    }

    #[Route('/template/delete/{id}', methods: [Request::METHOD_DELETE])]
    public function deleteTemplate(int $id): JsonResponse
    {
        return new JsonResponse($this->templateService->deleteTemplate($id));
    }
}
