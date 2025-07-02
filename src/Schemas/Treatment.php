<?php

namespace Hanafalah\ModuleTreatment\Schemas;

use Hanafalah\ModuleService\Schemas\Service;
use Illuminate\Database\Eloquent\Builder;
use Hanafalah\ModuleTreatment\Contracts;
use Illuminate\Database\Eloquent\Collection;
use Hanafalah\ModuleTreatment\Resources\Treatment\{
    ViewTreatment,
    ShowTreatment
};
use Illuminate\Pagination\LengthAwarePaginator;

class Treatment extends Service implements Contracts\Schemas\Treatment
{
    protected string $__entity = 'Treatment';
    protected static $treatment_model;
}
