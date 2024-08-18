<?php

namespace Ante\DnsParcer\TXTRecords;

class OTHER extends V {
    
    protected string $value;
    protected string $version;

    function __construct(string $value)
    {
        $this->type = 'OTHER';
        $this->version = '0';
        $this->value = $this->cast('value',$value);
    }

    function castValue(string $value): string
    {
        return $this->prepareText($value);
    }
}