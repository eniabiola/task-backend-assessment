<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function testing()
    {
        $public_holidays = Http::get('https://www.gov.uk/bank-holidays.json');
        $value = '2022-05-02';
        if ($public_holidays->successful()) {
            $bank_holidays = $public_holidays->json();
            $bank_holidays = collect($bank_holidays['england-and-wales']['events']);
            $bank_holidays =  $bank_holidays->filter(function ($bank_holiday) use ($value) {
                return $bank_holiday['date'] === $value;
            });
            if ($bank_holidays->isNotEmpty())
            {
                $holidays = array_values($bank_holidays->toArray())[0];

                return $holidays['title'] . $holidays['date'];
            }
        }
        return $public_holidays;
    }
}
