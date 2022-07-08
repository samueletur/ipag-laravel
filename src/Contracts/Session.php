<?php

namespace Samueletur\IpagLaravel\Contracts;

use Samueletur\IpagLaravel\Http\Config;

interface Session
{
    public function __construct(Config $config);

    public function getSession($clientIpagId);

    public function expired($clientIpagId): bool;

    public function getClientCredentials($clientIpagId = null): array;

    public function getPartnerCredentials(): array;

    public function updateOrCreate($clientIpagId, $values = []): void;

    public function remove($clientIpagId): bool;
}
