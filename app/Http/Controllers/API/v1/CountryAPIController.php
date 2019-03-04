<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\API\ApiBaseController;
use App\Services\CountryAPIServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


/**
 * Class CountryAPIController
 * @package App\Http\Controllers\API
 */
class CountryAPIController extends ApiBaseController
{
    /**
     * CountryAPIController constructor.
     * @param CountryAPIServices $countryAPIServices
     */
    public function __construct(CountryAPIServices $countryAPIServices)
    {
        $this->countryAPIServices = $countryAPIServices;
    }

    /**
     * Get list of countries
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountryList()
    {
        $countries = $this->countryAPIServices->getCountryList();

        return $this
            ->setStatusCode(200)
            ->setDataBag($countries)
            ->respond(true, trans('Country list'));
    }

    /**
     * Get list of cities based on country id
     * @param $countryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCityList($countryId)
    {
        $cities = $this->countryAPIServices->getCityList($countryId);

        return $this
            ->setStatusCode(200)
            ->setDataBag($cities)
            ->respond(true, trans('City list'));
    }
}