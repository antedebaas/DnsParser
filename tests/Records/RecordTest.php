<?php

namespace Ante\DnsParcer\Test\Records;

use PHPUnit\Framework\TestCase;
use Ante\DnsParcer\Records\A;
use Ante\DnsParcer\Records\Record;

class RecordTest extends TestCase
{
    /** @test */
    public function a_record_is_macroable()
    {
        Record::macro('ping', fn () => 'pong');

        $record = A::parse('spatie.be.              900     IN      A       138.197.187.74');

        $this->assertEquals('pong', $record->ping());
    }
}
