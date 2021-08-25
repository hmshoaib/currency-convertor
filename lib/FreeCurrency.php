<?php
class FreeCurrency
{

    public function fetch()
    {
        $url = "https://free.currconv.com/api/v7/convert?apiKey=f1884ff9269d7e16b4ed&q=MYR_USD,MYR_EUR";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
        $response = curl_exec($ch);
        curl_close($ch);
        $currencyData = json_decode($response, true);
        if (!$currencyData) {
            throw new Exception('API_DOWN');
        }
        return [
            'USD' => $currencyData['results']['MYR_USD']['val'],
            'EUR' => $currencyData['results']['MYR_EUR']['val']
        ];
    }
}
