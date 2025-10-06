<?php

namespace Hanafalah\ModuleTreatment\Schemas;

use Hanafalah\ModuleService\Schemas\Service;
use Hanafalah\ModuleTreatment\Contracts;
use Hanafalah\ModuleTreatment\Contracts\Data\TreatmentData;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Service implements Contracts\Schemas\Treatment
{
    protected string $__entity = 'Treatment';
    protected $treatment_model;

    public function prepareStoreTreatment(TreatmentData $treatment_dto): Model{
        return parent::prepareStoreService($treatment_dto);
    }
}
