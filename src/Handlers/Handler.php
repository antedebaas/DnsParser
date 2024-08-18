<?php

namespace Ante\DnsParcer\Handlers;

use Ante\DnsParcer\Exceptions\InvalidArgument;
use Ante\DnsParcer\Records\Record;
use Ante\DnsParcer\Support\Factory;

abstract class Handler
{
    protected ?string $nameserver = null;

    public function __construct(protected Factory $factory)
    {
    }

    public function useNameserver(?string $nameserver): self
    {
        $this->nameserver = $nameserver;

        return $this;
    }

    /**
     * @param string $domain
     * @param int $flag
     * @param string $type
     * @return \Ante\DnsParcer\Records\Record[]
     */
    abstract public function __invoke(string $domain, int $flag, string $type): array;

    abstract public function canHandle(): bool;

    protected function transform(string $type, array $records): array
    {
        return array_filter(array_map(
            function (string | array $record) use ($type): ?Record {
                try {
                    return is_string($record)
                        ? $this->factory->parse($type, $record)
                        : $this->factory->make($type, $record);
                } catch (InvalidArgument) {
                    return null;
                }
            },
            $records
        ));
    }
}
