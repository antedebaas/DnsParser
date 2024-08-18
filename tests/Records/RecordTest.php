<?php

namespace Ante\DnsParser\Test\Records;

use Ante\DnsParser\Records\A;
use Ante\DnsParser\Records\Record;
use PHPUnit\Framework\TestCase;

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
