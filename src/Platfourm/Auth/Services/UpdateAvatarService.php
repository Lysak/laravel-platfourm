<?php

namespace Longman\Platfourm\Auth\Services;

use GuzzleHttp\Client;
use Illuminate\Contracts\Cache\Repository as Cache;
use Longman\Platfourm\Contracts\Auth\AuthUserService;
use Longman\Platfourm\Service\EntityService;
use Longman\Platfourm\User\Repositories\Eloquent\UserRepository;

class UpdateAvatarService extends EntityService
{
    protected $repository;
    protected $authUserService;
    protected $httpClient;
    protected $cache;

    public function __construct(
        AuthUserService $authUserService,
        UserRepository $repository,
        Client $httpClient,
        Cache $cache
    ) {
        $this->authUserService = $authUserService;
        $this->repository      = $repository;
        $this->httpClient      = $httpClient;
        $this->cache           = $cache;
    }

    public function run()
    {
        $this->checkRepository();

        $data = $this->repository->updateAvatar($this->httpClient, $this->cache, $this->authUserService);

        return $data;
    }
}
