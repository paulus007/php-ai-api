<?php

namespace App\Service;

use App\Entity\Template;
use App\Repository\TemplateRepository;
use App\Representation\Page;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class TemplateService
{
    public function __construct(
        private TemplateRepository $templateRepository,
    ) {
    }

    public function getTemplate(int $id): ?Template
    {
        return $this->templateRepository->findOne($id) ?? throw new NotFoundHttpException(sprintf('Template with id %d not found', $id));
    }

    public function getTemplates(int $offset, int $limit, string $search): Page
    {
        return $this->templateRepository->findPage($offset, $limit, $search);
    }

    public function postTemplate(array $requestData): Template
    {
        $template = new Template(
            name: $requestData['name'] ?? throw new BadRequestException('Required data missing'),
        );

        return $this->templateRepository->saveItem($template);
    }

    public function putTemplate(array $requestData, int $id): Template
    {
        $template = $this->templateRepository->findOne($id);

        if ($template === null) {
            throw new NotFoundHttpException(sprintf('Template with id %d not found', $id));
        }

        $template->setName($requestData['name'] ?? throw new BadRequestException('Required data missing'));

        return $this->templateRepository->saveItem($template);
    }

    public function patchTemplate(array $requestData, int $id): Template
    {
        $template = $this->templateRepository->findOne($id);

        if ($template === null) {
            throw new NotFoundHttpException(sprintf('Template with id %d not found', $id));
        }

        $template->setName($requestData['name'] ?? $template->getName());

        return $this->templateRepository->saveItem($template);
    }

    public function deleteTemplate(int $id): null
    {
        $template = $this->templateRepository->findOne($id);

        if ($template === null) {
            throw new NotFoundHttpException(sprintf('Template with id %d not found', $id));
        }

        $this->templateRepository->deleteItem($template);

        return null;
    }
}
