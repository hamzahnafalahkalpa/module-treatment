<?php

namespace Hanafalah\ModuleTreatment\Data;

use Hanafalah\ModuleService\Data\ServiceData;
use Hanafalah\ModuleTreatment\Contracts\Data\TreatmentData as DataTreatmentData;

class TreatmentData extends ServiceData implements DataTreatmentData{
    public static function after(mixed $data): self{
        $data->props['is_treatment'] = true;
        $data = parent::after($data);
        return $data;
    }
}