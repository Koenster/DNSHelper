<?php namespace koenster\DNSCHecker\Tests;

use koenster\DNSChecker\DNSCollection;

class DNSTest extends \PHPUnit_Framework_TestCase {

    /** @var DNSCollection */
    protected $DNSCollection;

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
        $this->DNSCollection = new DNSCollection();
        $this->mockery = new \Mockery();
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
        $this->mockery->close();
        parent::tearDown();
    }

    /**
     * Test the a record
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     */
    public function testARecordTest()
    {
        $this->DNSCollection->setARecords('192.168.1.1');
        $this->DNSCollection->setARecords('192.168.1.2');
        $this->assertSame(['192.168.1.1', '192.168.1.2'], $this->DNSCollection->getARecords());
    }

    /**
     * Test the aaaa record
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     */
    public function testAAAARecordTest()
    {
        $this->DNSCollection->setARecords('FE80:0000:0000:0000:0202:B3FF');
        $this->DNSCollection->setARecords('2001:cdba:0000:0000:3257.9652');
        $this->assertSame(['FE80:0000:0000:0000:0202:B3FF', '2001:cdba:0000:0000:3257.9652'],
        $this->DNSCollection->getARecords());
    }

    /**
     * Test the mx record
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     */
    public function testMXRecordTest()
    {
        $this->DNSCollection->setMXRecords(['37.252.122.107', 30]);
        $this->DNSCollection->setMXRecords(['192.168.1.1', 10]);
        $this->assertSame([['37.252.122.107', 30], ['192.168.1.1', 10]],
        $this->DNSCollection->getMXRecords());
    }

    /**
     * Test the mx record
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     */
    public function testNSRecordTest()
    {
        $this->DNSCollection->setNSRecords('ns0.transip.net');
        $this->DNSCollection->setNSRecords('ns1.transip.net');
        $this->assertSame(['ns0.transip.net', 'ns1.transip.net'],
        $this->DNSCollection->getNSRecords());
    }


    /**
     * Test the txt record
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     */
    public function testTXTRecordTest()
    {
        $this->DNSCollection->setTXTRecords('txt1');
        $this->DNSCollection->setTXTRecords('txt2');
        $this->assertSame(['txt1', 'txt2'],
        $this->DNSCollection->getTXTRecords());
    }
}