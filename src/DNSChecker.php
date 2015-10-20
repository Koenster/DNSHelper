<?php namespace koenster\DNSChecker;

use koenster\DNSChecker\Contract\DNSCheckerContract;

class DNSChecker implements DNSCheckerContract {

    const ARecords = 'ARecords';
    const AAAARecords = 'AAAARecords';
    const MXRecords = 'MXRecords';
    const TXTRecords = 'TXTRecords';
    const NSRecords = 'NSRecords';

    const RULE_ALL = 'ALL';
    const RULE_ANY = 'ANY';

    /** @var DNSCollection */
    protected $DNSCollection;

    /** @var array */
    protected $errors = null;

    /**
     * Sets the collection
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     *
     * @param DNSCollection $DNSCollection
     *
     * @return $this
     */
    public function setDNSCollection(DNSCollection $DNSCollection)
    {
        $this->DNSCollection = $DNSCollection;
        return $this;
    }

    /**
     * Gets the DNS collection
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     *
     * @return DNSCollection
     */
    public function getDNSCollection()
    {
        return $this->DNSCollection;
    }

    /**
     * Checks if there are errors
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     *
     * @return bool
     */
    public function hasErrors()
    {
        if ($this->errors !== null) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * {@inheritdoc}
     */
    public function expect($type, $rule, $key, array $expected)
    {
        if ($type === self::ARecords) {
            $this->check($type, $rule, $key, $expected, $this->DNSCollection->getARecords());
        } else if ($type === self::AAAARecords) {
            $this->check($type, $rule, $key, $expected, $this->DNSCollection->getAAAARecords());
        } else if ($type === self::MXRecords) {
            $this->check($type, $rule, $key, $expected, $this->DNSCollection->getMXRecords());
        } else if ($type === self::TXTRecords) {
            $this->check($type, $rule, $key, $expected, $this->DNSCollection->getTXTRecords());
        } else if ($type === self::NSRecords) {
            $this->check($type, $rule, $key, $expected, $this->DNSCollection->getNSRecords());
        }

        return $this;
    }

    /**
     * Check the value
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     *
     * @param $type
     * @param $rule
     * @param $key
     * @param array $expected
     * @param array $values
     */
    public function check($type, $rule, $key, array $expected, array $values)
    {
        $errors = null;

        if ($rule === self::RULE_ANY) {

            foreach ($values as $record) {
                if (in_array($record, $expected) === true) {
                    return;
                }
            }

            $errors[$key] = [
                'expected' => $expected,
                'values' => $values
            ];

        } else {

            foreach ($values as $record) {
                if (in_array($record, $expected) === false) {
                    $errors[$key] = [
                        'expected' => $expected,
                        'values' => $values
                    ];
                }
            }

        }

        if ($errors) {
            $this->errors[$type] = $errors;
        }
    }
}