<?php
class Convertor
{

    private $baseCurrency;

    private $conversionRate;

    public function __construct()
    {
        $this->baseCurrency =  Currency::fromCode("MYR");
        $this->conversionRate = new ConversionRate();
    }

    public function convert(Money $from, Currency $to)
    {
        if ($from->currency()->equals($to)) {
            return $from;
        }

        if (!$from->currency()->equals($this->baseCurrency) && !$to->equals($this->baseCurrency)) {

            $rate = $this->conversionRate->getRate($from->currency());
            $rate = 1 / $rate;
            $from  = $from->convertTo($this->baseCurrency, $rate);

            $rate = $this->conversionRate->getRate($to);
            return $from->convertTo($to, $rate);
        }

        if ($to->equals($this->baseCurrency)) {
            $rate = $this->conversionRate->getRate($from->currency());
            $rate = 1 / $rate;
        } else {
            $rate = $this->conversionRate->getRate($to);
        }
        return $from->convertTo($to, $rate);
    }
}
