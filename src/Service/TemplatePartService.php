<?php

namespace App\Service;

use App\Entity\TemplatePart;
use App\Repository\TemplatePartRepository;
use App\Repository\TemplateRepository;
use App\Representation\Page;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class TemplatePartService
{
    public function __construct(
        private TemplateRepository $templateRepository,
        private TemplatePartRepository $templatePartRepository,
    ) {
    }

    public function getTemplatePart(int $id): ?TemplatePart
    {
        return $this->templatePartRepository->findOne($id) ?? throw new NotFoundHttpException(sprintf('TemplatePart with id %d not found', $id));
    }

    public function getTemplateParts(int $offset, int $limit, string $search): Page
    {
        return $this->templatePartRepository->findPage($offset, $limit, $search);
    }

    public function postTemplatePart(array $requestData): TemplatePart
    {
        $template = $this->templateRepository->findOne($requestData['template_id'] ?? throw new BadRequestException('Required data missing'));

        if ($template === null) {
            throw new NotFoundHttpException(sprintf('TemplatePart with id %d not found', $requestData['template_id']));
        }

        $template = new TemplatePart(
            template: $template,
            name: $requestData['name'] ?? throw new BadRequestException('Required data missing'),
        );

        return $this->templatePartRepository->saveItem($template);
    }

    public function putTemplatePart(array $requestData, int $id): TemplatePart
    {
        $template = $this->templatePartRepository->findOne($id);

        if ($template === null) {
            throw new NotFoundHttpException(sprintf('TemplatePart with id %d not found', $id));
        }

        $template->setName($requestData['name'] ?? throw new BadRequestException('Required data missing'));

        return $this->templatePartRepository->saveItem($template);
    }

    public function patchTemplatePart(array $requestData, int $id): TemplatePart
    {
        $template = $this->templatePartRepository->findOne($id);

        if ($template === null) {
            throw new NotFoundHttpException(sprintf('TemplatePart with id %d not found', $id));
        }

        $template->setName($requestData['name'] ?? $template->getName());

        return $this->templatePartRepository->saveItem($template);
    }

    public function deleteTemplatePart(int $id): null
    {
        $template = $this->templatePartRepository->findOne($id);

        if ($template === null) {
            throw new NotFoundHttpException(sprintf('TemplatePart with id %d not found', $id));
        }

        $this->templatePartRepository->deleteItem($template);

        return null;
    }
}
