<?php

namespace Ante\DnsParser\Handlers;

use Ante\DnsParser\Exceptions\CouldNotFetchDns;
use Throwable;

class DnsGetRecord extends Handler
{
    public function __invoke(string $domain, int $flag, string $type): array
    {
        $records = false;
        $error = '';

        try {
            $records = dns_get_record($domain, $flag);
        } catch (Throwable $exception) {
            $error = $exception->getMessage();
        }

        if ($records === false) {
            throw CouldNotFetchDns::dnsGetRecordReturnedWithError($error);
        }

        return $this->transform($type, $records);
    }

    public function canHandle(): bool
    {
        return function_exists('dns_get_record');
    }
}
