<?php namespace koenster\DNSChecker;

class DNSCollection {

    /** @var array */
    protected $ARecords = [];

    /** @var array */
    protected $AAAARecords = [];

    /** @var array */
    protected $MXRecords = [];

    /** @var array */
    protected $TXTRecords = [];

    /** @var array */
    protected $NSRecords = [];

    /**
     * @return array
     */
    public function getARecords()
    {
        return $this->ARecords;
    }

    /**
     * @param array $ARecords
     *
     * @return $this
     */
    public function setARecords($ARecords)
    {
        array_push($this->ARecords, $ARecords);
        return $this;
    }

    /**
     * @return array
     */
    public function getAAAARecords()
    {
        return $this->AAAARecords;
    }

    /**
     * @param array $AAAARecords
     *
     * @return $this
     */
    public function setAAAARecords($AAAARecords)
    {
        array_push($this->AAAARecords,$AAAARecords);
        return $this;
    }

    /**
     * @return array
     */
    public function getMXRecords()
    {
        return $this->MXRecords;
    }

    /**
     * @param array $MXRecords
     *
     * @return $this
     */
    public function setMXRecords($MXRecords)
    {
        array_push($this->MXRecords, $MXRecords);
        return $this;
    }

    /**
     * @return array
     */
    public function getTXTRecords()
    {
        return $this->TXTRecords;
    }

    /**
     * @param array $TXTRecords
     *
     * @return $this
     */
    public function setTXTRecords($TXTRecords)
    {
        array_push($this->TXTRecords, $TXTRecords);

        return $this;
    }

    /**
     * @return array
     */
    public function getNSRecords()
    {
        return $this->NSRecords;
    }

    /**
     * @param array $NSRecords
     *
     * @return $this
     */
    public function setNSRecords($NSRecords)
    {
        array_push($this->NSRecords, $NSRecords);

        return $this;
    }
}