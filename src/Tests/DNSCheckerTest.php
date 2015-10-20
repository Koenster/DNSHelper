<?php namespace koenster\DNSCHecker\Tests;

use koenster\DNSChecker\DNSCollection;
use koenster\DNSChecker\DNSChecker;

class DNSCheckerTest extends \PHPUnit_Framework_TestCase {

    /** @var DNSChecker */
    protected $DNSChecker;

    /** @var \Mockery */
    protected $mockery;

    /**
     * Start
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     */
    public function setUp()
    {
        $DNSCollection = new DNSCollection();
        $DNSCollection->setARecords('192.168.1.1')
            ->setAAAARecords('super.long.aaaa.record')
            ->setMXRecords(['mail.test', 10])
            ->setTXTRecords('long.txt.record')
            ->setNSRecords('NS1.example.com');

        $this->DNSChecker = new DNSChecker;
        $this->DNSChecker->setDNSCollection($DNSCollection);

        parent::setUp();
    }

    /**
     * Destroy
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Test A record
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     */
    public function testARecord()
    {
        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::ARecords, DNSChecker::RULE_ALL, 'A', ['192.168.1.1'])->getErrors();
        $this->assertSame(null, $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::ARecords, DNSChecker::RULE_ALL, 'A', ['192.168.1.2'])->getErrors();
        $this->assertSame([DNSChecker::ARecords => ['A' => ['expected' => ['192.168.1.2'], 'values' => ['192.168.1.1']]]], $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::ARecords, DNSChecker::RULE_ANY, 'A', ['192.168.1.2', '192.168.1.1'])->getErrors();
        $this->assertSame(null, $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::ARecords, DNSChecker::RULE_ANY, 'A', ['192.168.1.2', '192.168.1.3'])->getErrors();
        $this->assertSame([DNSChecker::ARecords => ['A' => ['expected' => ['192.168.1.2', '192.168.1.3'], 'values' => ['192.168.1.1']]]], $result);
    }

    /**
     * Test AAAA record
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     */
    public function testAAAARecord()
    {
        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::AAAARecords, DNSChecker::RULE_ALL, 'AAAA', ['super.long.aaaa.record'])->getErrors();
        $this->assertSame(null, $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::AAAARecords, DNSChecker::RULE_ALL, 'AAAA', ['super.long.aaaa.record.2'])->getErrors();
        $this->assertSame([DNSChecker::AAAARecords => ['AAAA' => ['expected' => ['super.long.aaaa.record.2'], 'values' => ['super.long.aaaa.record']]]], $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::AAAARecords, DNSChecker::RULE_ANY, 'AAAA', ['super.long.aaaa.record.2', 'super.long.aaaa.record'])->getErrors();
        $this->assertSame(null, $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::AAAARecords, DNSChecker::RULE_ANY, 'AAAA', ['super.long.aaaa.record.2', 'super.long.aaaa.record.3'])->getErrors();
        $this->assertSame([DNSChecker::AAAARecords => ['AAAA' => ['expected' => ['super.long.aaaa.record.2', 'super.long.aaaa.record.3'], 'values' => ['super.long.aaaa.record']]]], $result);
    }

    /**
     * Test MX record
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     */
    public function testMXRecord()
    {
        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::MXRecords, DNSChecker::RULE_ALL, 'MX', [['mail.test', 10]])->getErrors();
        $this->assertSame(null, $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::MXRecords, DNSChecker::RULE_ALL, 'MX', [['mail.test', 20]])->getErrors();
        $this->assertSame([DNSChecker::MXRecords => ['MX' => ['expected' => [['mail.test', 20]], 'values' => [['mail.test', 10]]]]], $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::MXRecords, DNSChecker::RULE_ANY, 'MX', [['mail.test', 20], ['mail.test', 10]])->getErrors();
        $this->assertSame(null, $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::MXRecords, DNSChecker::RULE_ANY, 'MX', [['mail.test', 20], ['mail.test', 30]])->getErrors();
        $this->assertSame([DNSChecker::MXRecords => ['MX' => ['expected' => [['mail.test', 20], ['mail.test', 30]], 'values' => [['mail.test', 10]]]]], $result);
    }

    /**
     * Test TXT record
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     */
    public function testTXTRecord()
    {
        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::TXTRecords, DNSChecker::RULE_ALL, 'TXT', ['long.txt.record'])->getErrors();
        $this->assertSame(null, $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::TXTRecords, DNSChecker::RULE_ALL, 'TXT', ['long.txt.record2'])->getErrors();
        $this->assertSame([DNSChecker::TXTRecords => ['TXT' => ['expected' => ['long.txt.record2'], 'values' => ['long.txt.record']]]], $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::TXTRecords, DNSChecker::RULE_ANY, 'TXT', ['long.txt.record2', 'long.txt.record'])->getErrors();
        $this->assertSame(null, $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::TXTRecords, DNSChecker::RULE_ANY, 'TXT', ['long.txt.record2', 'long.txt.record3'])->getErrors();
        $this->assertSame([DNSChecker::TXTRecords => ['TXT' => ['expected' => ['long.txt.record2', 'long.txt.record3'], 'values' => ['long.txt.record']]]], $result);
    }

    /**
     * Test NS record
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     */
    public function testNSRecord()
    {
        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::NSRecords, DNSChecker::RULE_ALL, 'TXT', ['NS1.example.com'])->getErrors();
        $this->assertSame(null, $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::NSRecords, DNSChecker::RULE_ALL, 'TXT', ['NS2.example.com'])->getErrors();
        $this->assertSame([DNSChecker::NSRecords => ['TXT' => ['expected' => ['NS2.example.com'], 'values' => ['NS1.example.com']]]], $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::NSRecords, DNSChecker::RULE_ANY, 'TXT', ['NS2.example.com', 'NS1.example.com'])->getErrors();
        $this->assertSame(null, $result);

        $DNSChecker = clone $this->DNSChecker;
        $result = $DNSChecker->expect(DNSChecker::NSRecords, DNSChecker::RULE_ANY, 'TXT', ['NS2.example.com', 'NS3.example.com'])->getErrors();
        $this->assertSame([DNSChecker::NSRecords => ['TXT' => ['expected' => ['NS2.example.com', 'NS3.example.com'], 'values' => ['NS1.example.com']]]], $result);
    }
}