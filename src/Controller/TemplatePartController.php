<?php

namespace App\Controller;

use App\Service\TemplatePartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class TemplatePartController extends AbstractController
{
    public function __construct(
        private readonly TemplatePartService $templatePartService,
    ) {
    }

    #[Route('/template_part/{id}', methods: [Request::METHOD_GET])]
    public function getTemplatePart(int $id): JsonResponse
    {
        return new JsonResponse($this->templatePartService->getTemplatePart($id));
    }

    #[Route('/template_parts/{offset}/{limit}/{search}', methods: [Request::METHOD_GET])]
    public function getTemplates(int $offset = 0, int $limit = 0, string $search = ''): JsonResponse
    {
        return new JsonResponse($this->templatePartService->getTemplateParts($offset, $limit, $search));
    }

    #[Route('/template_part/post', methods: [Request::METHOD_POST])]
    public function postTemplatePart(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->templatePartService->postTemplatePart($request->toArray())
        );
    }

    #[Route('/template_part/put/{id}', methods: [Request::METHOD_PUT])]
    public function putTemplatePart(Request $request, int $id): JsonResponse
    {
        return new JsonResponse($this->templatePartService->putTemplatePart($request->toArray(), $id));
    }

    #[Route('/template_part/patch/{id}', methods: [Request::METHOD_PATCH])]
    public function patchTemplatePart(Request $request, int $id): JsonResponse
    {
        return new JsonResponse($this->templatePartService->patchTemplatePart($request->toArray(), $id));
    }

    #[Route('/template_part/delete/{id}', methods: [Request::METHOD_DELETE])]
    public function deleteTemplatePart(int $id): JsonResponse
    {
        return new JsonResponse($this->templatePartService->deleteTemplatePart($id));
    }
}
