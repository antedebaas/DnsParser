<?php

namespace Ante\DnsParser\Test\TestClasses;

use Ante\DnsParser\Handlers\Handler;

class CustomHandler extends Handler
{
    public function __construct()
    {
        // override default constructor
    }

    public function __invoke(string $domain, int $flag, string $type): array
    {
        return ["custom-handler-results-{$type}"];
    }

    public function canHandle(): bool
    {
        return true;
    }
}
