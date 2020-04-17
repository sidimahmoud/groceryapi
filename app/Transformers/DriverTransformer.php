<?php

namespace App\Transformers;

use App\DriverData;
use League\Fractal\TransformerAbstract;

class DriverTransformer extends TransformerAbstract
{
    /**
     * Transform model
     *
     * @param Setting $setting
     * @return array
     */
    public function transform(DriverData $setting)
    {
        return $setting->toArray();
    }
}
