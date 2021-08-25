<?php

final class Money
{


    private float $amount;

    private Currency $currency;


    private function __construct(float $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public static function __callStatic(string $method, array $arguments)
    {
        return self::fromAmount($arguments[0], Currency::fromCode($method));
    }

    public static function fromAmount($amount, Currency $currency)
    {
        return new self($amount, $currency);
    }

    public function amount(): string
    {
        return $this->amount;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function convertTo(Currency $targetCurrency, $conversionRate): Money
    {
        $amount = $this->amount * $conversionRate;

        return new self($amount, $targetCurrency);
    }

    public function __toString()
    {
        return $this->currency()->code() . ' ' . number_format($this->amount, 4);
    }
}
