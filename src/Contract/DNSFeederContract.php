<?php namespace koenster\DNSChecker\Contract;

use koenster\DNSChecker\DNSCollection;

interface DNSFeederContract {

    /**
     * Feeds the DNS records from given implementation
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     *
     * @return DNSCollection
     */
    public function feed($domainName);
}