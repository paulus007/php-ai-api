<?php

namespace App\Service;

use App\Entity\Provider;
use App\Repository\ProviderRepository;
use App\Representation\Page;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class ProviderService
{
    public function __construct(
        private ProviderRepository $providerRepository,
    ) {
    }

    public function getProvider(int $id): ?Provider
    {
        return $this->providerRepository->findOne($id) ?? throw new NotFoundHttpException(sprintf('Provider with id %d not found', $id));
    }

    public function getProviders(int $offset, int $limit, string $search): Page
    {
        return $this->providerRepository->findPage($offset, $limit, $search);
    }

    public function postProvider(array $requestData): Provider
    {
        $provider = new Provider(
            name: $requestData['name'] ?? throw new BadRequestException('Required data missing'),
            description: $requestData['description'] ?? throw new BadRequestException('Required data missing'),
            url: $requestData['url'] ?? throw new BadRequestException('Required data missing'),
            active: $requestData['active'] ?? false,
            rfResident: $requestData['rfResident'] ?? false,
            needProxy: $requestData['needProxy'] ?? false,
        );

        return $this->providerRepository->saveItem($provider);
    }

    public function putProvider(array $requestData, int $id): Provider
    {
        $provider = $this->providerRepository->findOne($id);

        if ($provider === null) {
            throw new NotFoundHttpException(sprintf('Provider with id %d not found', $id));
        }

        $provider->setName($requestData['name'] ?? throw new BadRequestException('Required data missing'));
        $provider->setDescription($requestData['description'] ?? throw new BadRequestException('Required data missing'));
        $provider->setUrl($requestData['url'] ?? throw new BadRequestException('Required data missing'));
        $provider->setActive($requestData['active'] ?? throw new BadRequestException('Required data missing'));
        $provider->setRfResident($requestData['rfResident'] ?? throw new BadRequestException('Required data missing'));
        $provider->setNeedProxy($requestData['needProxy'] ?? throw new BadRequestException('Required data missing'));

        return $this->providerRepository->saveItem($provider);
    }

    public function patchProvider(array $requestData, int $id): Provider
    {
        $provider = $this->providerRepository->findOne($id);

        if ($provider === null) {
            throw new NotFoundHttpException(sprintf('Provider with id %d not found', $id));
        }

        $provider->setName($requestData['name'] ?? $provider->getName());
        $provider->setDescription($requestData['description'] ?? $provider->getDescription());
        $provider->setUrl($requestData['url'] ?? $provider->getUrl());
        $provider->setActive($requestData['active'] ?? $provider->isActive());
        $provider->setRfResident($requestData['rfResident'] ?? $provider->isRfResident());
        $provider->setNeedProxy($requestData['needProxy'] ?? $provider->isNeedProxy());

        return $this->providerRepository->saveItem($provider);
    }

    public function deleteProvider(int $id): null
    {
        $provider = $this->providerRepository->findOne($id);

        if ($provider === null) {
            throw new NotFoundHttpException(sprintf('Provider with id %d not found', $id));
        }

        $this->providerRepository->deleteItem($provider);

        return null;
    }
}
