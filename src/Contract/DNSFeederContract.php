<?php namespace koenster\DNSChecker\Contract;

use koenster\DNSChecker\DNS;

interface DNSFeederContract {

    /**
     * Feeds the DNS records from given implementation
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     *
     * @return DNS
     */
    public function feed($domainName);
}