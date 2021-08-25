<?php

class ConversionRate
{
    private $currencyRateRepository;

    private $freeCurrency;

    public function __construct()
    {
        $this->currencyRateRepository = new CurrencyRateRepository();
        $this->freeCurrency = new FreeCurrency();
    }

    public function getRate(Currency $target)
    {
        $rate = $this->currencyRateRepository->getRate($target);

        /**
         * If not found in DB fetch from API
         */
        if(null == $rate){  
          $currencyValueMap =  $this->freeCurrency->fetch();
          foreach($currencyValueMap as $code => $rate){
              $this->currencyRateRepository->save($code, $rate);
          }
          return $currencyValueMap[$target->code()];
        }

        return $rate;
    }
}
