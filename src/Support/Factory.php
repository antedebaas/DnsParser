<?php

namespace Ante\DnsParcer\Support;

use Ante\DnsParcer\Handlers\UnsupportedRecordType;
use Ante\DnsParcer\Records\Record;

class Factory
{
    public function parse(string $type, string $line): ?Record
    {
        return forward_static_call([$this->resolve($type), 'parse'], $line);
    }

    public function make(string $type, array $record): Record
    {
        return forward_static_call([$this->resolve($type), 'make'], $record);
    }

    public function guess(string $line): ?Record
    {
        $parts = preg_split('/\s+/', $line);

        if (! $type = $parts[3] ?? null) {
            return null;
        }

        return $this->parse($type, $line);
    }

    protected function resolve(string $type): string
    {
        $type = mb_strtoupper($type);

        $class = "Ante\\DnsParcer\\Records\\{$type}";

        if (! in_array($type, Types::getTypes()) || ! class_exists($class)) {
            throw UnsupportedRecordType::make($type);
        }

        return $class;
    }
}
