<?php

namespace App\Services;

use App\Http\Controllers\API\ApiBaseController;
use App\Models\Country;
use App\Models\WorldCountries;
use App\Models\WorldCities;
/**
 * Class CountryAPIServices
 * @package App\Http\Controllers\API
 */
class CountryAPIServices extends  ApiBaseController
{
    /**
     * CountryAPIServices constructor.
     */
    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    /**
     * Get list of countries
     * @return mixed
     */
    public function getCountryList()
    {
        $countries = WorldCountries::get()->toArray();
        return $countries;
    }

    /**
     * Get list of ciities based on country id
     * @param $countryId
     * @return mixed
     */
    public function getCityList($countryId)
    {
        $cities = WorldCities::where('country_id', $countryId)->get()->toArray();

        return $cities;
    }
}