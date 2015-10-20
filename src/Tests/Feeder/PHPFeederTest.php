<?php namespace koenster\DNSCHecker\Tests\Feeder;

use koenster\DNSChecker\Contract\DNSFeederContract;
use koenster\DNSChecker\Feeder\PHPFeeder;

class PHPFeederTest extends \PHPUnit_Framework_TestCase {

    /** @var DNSFeederContract */
    protected $feeder;

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
        $this->feeder = new PHPFeeder();
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
     * Test the a record
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     */
    public function testFeederPHPTest()
    {
        $result = $this->feeder->feed('seats2meet.com');
        $this->assertInstanceOf('koenster\DNSChecker\DNSCollection', $result);
    }
}