<?php namespace koenster\DNSChecker\Feeder;

use koenster\DNSChecker\Contract\DNSFeederContract;
use koenster\DNSChecker\DNSCollection;

class PHPFeeder implements DNSFeederContract {

    /**
     * {@inheritdoc}
     */
    public function feed($domainName)
    {
        $DNSCollection = new DNSCollection();

        $records = dns_get_record($domainName, DNS_ALL);

        foreach ($records as $record) {

            if (isset($record['type']) === false) {
                continue;
            }

            if ($record['type'] === 'A') {
                $DNSCollection->setARecords($record['ip']);
            } elseif ($record['type'] === 'AAAA') {
                $DNSCollection->setAAAARecords($record['ipv6']);
            } elseif ($record['type'] === 'MX') {
                $DNSCollection->setMXRecords([$record['target'], $record['pri']]);
            } elseif ($record['type'] === 'TXT') {
                $DNSCollection->setTXTRecords($record['txt']);
            } elseif ($record['type'] === 'NS') {
                $DNSCollection->setNSRecords($record['target']);
            }
        }

        return $DNSCollection;
    }
}