<?php

namespace Ante\DnsParser\TXTRecords;

class STSV1 extends V
{
    protected int $id;

    public function __construct(string $value)
    {
        $this->type = 'STS';
        $this->version = 1;
        $this->id = $this->cast('id', $value);
    }

    public function castId(string $value): int
    {
        preg_match('/id=([0-9]+)/', $value, $matches);

        return $this->prepareInt($matches[1]);
    }
}
