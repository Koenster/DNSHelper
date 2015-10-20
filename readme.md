#DNSHelper

DNSHelper is a simple collection of objects to use DNS records with PHP in a more effective way than the normal get_dns_record from php.

The Helper exists of 2 parts:

*Feeder - Make a DNS Collection on a given implementation (only PHP at ths moment)
*Checker - Check the values from the DNS Collection to the expected values

##Installation

The best way to install DebugBar is using Composer with the following command:

```
composer require koenster/DNSHelper
```

##Feeder

At this moment we only have a PHP feeder. Other feeders, like an API or cURL request can be implemented (feel free to program).

```

use koenster\DNSChecker\Feeder\PHPFeeder;
$feeder = new PHPFeeder();
$DNSCollection = $feeder->feed('exenzo.com');

// Returning of the DNSCollection
koenster\DNSChecker\DNSCollection Object
(
    [ARecords:protected] => Array
        (
            [0] => 37.252.122.107
        )

    [AAAARecords:protected] => Array
        (
        )

    [MXRecords:protected] => Array
        (
            [0] => Array
                (
                    [0] => ASPMX3.GOOGLEMAIL.com
                    [1] => 50
                )
        )

    [TXTRecords:protected] => Array
        (
            [0] => v=spf1 include:_spf.moneybird.nl include:spf.mandrillapp.com ?all
        )

    [NSRecords:protected] => Array
        (
            [0] => ns1.transip.nl
        )

)

```

##DNSChecker

DNS Checker helps you with validating DNS Records.
Per record (A, AAAA, MX, TXT, NS) you can provide the expected values. Here you can also specify if you want to use the ANY or ALL rule. See code example below for explanation.

```
$feeder = new PHPFeeder();
$DNSCollection = $feeder->feed('exenzo.com');

$DNSChecker = new DNSChecker();
$DNSChecker->setDNSCollection($DNSCollection)
    ->expect(DNSChecker::ARecords, DNSChecker::RULE_ALL, 'A', ['37.252.122.107']) // ALL rule checks if the provided values are present in the DNS collection
    ->expect(DNSChecker::MXRecords, DNSChecker::RULE_ALL, 'MX', [
        ['ASPMX.L.GOOGLE.com', 10]
    ])
    ->expect(DNSChecker::TXTRecords, DNSChecker::RULE_ALL, 'TXT', [
        'v=spf1 include:_spf.moneybird.nl include:spf.mandrillapp.com ?all'
    ])
    ->expect(DNSChecker::NSRecords, DNSChecker::RULE_ALL, 'NS', [
        'ns1.transip.nl'
    ])
    ->expect(DNSChecker::ARecords, DNSChecker::RULE_ANY, 'A', ['192.168.1.1', '37.252.122.107']); // ANY will return true if any of the provided values matches the returned values of the DNS collection

if ($DNSChecker->hasErrors()) {
    echo "The following errors occurred:";
    print_r($DNSChecker->getErrors());
} else {
    echo "Woohoo, no DNS errors!";
}
```

##Warning
We have found some inconsistency within the settings on different servers. This is probably a configuration issue but we'll come back on this later.

##Todo's

*DNS tool seems not to be working on Homestead (vagrant). Let's look at the config files.
*check if TXT returns multiple entries in "entries" field

##Authors
Koen Blokland Visser
Richard Oosterhof