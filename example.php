<?php

require_once 'vendor/autoload.php';

use koenster\DNSChecker\DNSChecker;
use koenster\DNSChecker\Feeder\PHPFeeder;

$feeder = new PHPFeeder();
$DNSCollection = $feeder->feed('exenzo.com');

$DNSChecker = new DNSChecker();
$DNSChecker->setDNSCollection($DNSCollection)
    ->expect(DNSChecker::ARecords, DNSChecker::RULE_ALL, 'A', ['37.252.122.107'])
    ->expect(DNSChecker::MXRecords, DNSChecker::RULE_ALL, 'MX', [
        ['ASPMX.L.GOOGLE.com', 10],
        ['ALT1.ASPMX.L.GOOGLE.com', 20],
        ['ALT2.ASPMX.L.GOOGLE.com', 30],
        ['ASPMX2.GOOGLEMAIL.com', 40],
        ['ASPMX3.GOOGLEMAIL.com', 50],
        ['ASPMX4.GOOGLEMAIL.com', 60],
        ['ASPMX5.GOOGLEMAIL.com', 70]
    ])
    ->expect(DNSChecker::TXTRecords, DNSChecker::RULE_ALL, 'TXT', [
        'v=spf1 include:_spf.moneybird.nl include:spf.mandrillapp.com ?all',
        'google-site-verification=IWk3yZxysMgd1SW5gjTv9BCYjTGUSTKzEA96sKexRZs'
    ])
    ->expect(DNSChecker::NSRecords, DNSChecker::RULE_ALL, 'NS', [
        'ns1.transip.nl',
        'ns0.transip.net',
        'ns2.transip.eu'
    ]);

if ($DNSChecker->hasErrors()) {
    echo "The following errors occurred:";
    print_r($DNSChecker->getErrors());
} else {
    echo "Woohoo, no DNS errors!";
}

