<?php
namespace App\Library\Hydrators\Polygon;

class Stock
{
    /**
     * @var string $ticker
     */
    private string $ticker;

    /**
     * @var string $name
     */
    private string $name;

    /**
     * @var string $market
     */
    private string $market;

    /**
     * @var bool $active
     */
    private bool $active;

    /**
     * @var string $primary_exchange
     */
    private string $primary_exchange;

    /**
     * @return string
     */
    public function getTicker(): string
    {
        return $this->ticker;
    }

    /**
     * @param string $ticker
     */
    public function setTicker(string $ticker): void
    {
        $this->ticker = $ticker;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getMarket(): string
    {
        return $this->market;
    }

    /**
     * @param string $market
     */
    public function setMarket(string $market): void
    {
        $this->market = $market;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getPrimaryExchange(): string
    {
        return $this->primary_exchange;
    }

    /**
     * @param string $primary_exchange
     */
    public function setPrimaryExchange(string $primary_exchange): void
    {
        $this->primary_exchange = $primary_exchange;
    }



}