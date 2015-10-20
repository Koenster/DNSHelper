<?php namespace koenster\DNSChecker\Contract;

interface DNSCheckerContract {

    /**
     * Logs if your expectations are not met by your type (A Record, NS etc.) and rule (ALL, ANY)
     *
     * @param string $type
     * @param string $rule All given criteria are met, Any of the given criteria are met
     * @param string $key Reference
     * @param array $expected
     *
     * @return $this
     */
    public function expect($type, $rule, $key, array $expected);

    /**
     * Return the errors in an array like this:
     *
     * array[
     *      'ARecords' => [
     *          [
     *              $key => [
     *                  'expected' => $expected,
     *                  'values' => 'Real values'
     *              ]
     *          ]
     *      ]
     * ]
     *
     * @author Koen Blokland Visser
     * @author Richard Oosterhof
     *
     * @return array
     */
    public function getErrors();

}