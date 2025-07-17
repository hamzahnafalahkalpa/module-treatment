<?php

namespace Hanafalah\ModuleTreatment\Contracts\Schemas;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;

/**
 * @see \Hanafalah\ModuleTreatment\Schemas\Treatment
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method mixed export(string $type)
 * @method bool deleteTreatment()
 * @method bool prepareDeleteTreatment(? array $attributes = null)
 * @method mixed getTreatment()
 * @method ?Model prepareShowTreatment(?Model $model = null, ?array $attributes = null)
 * @method array showTreatment(?Model $model = null)
 * @method Collection prepareViewTreatmentList()
 * @method array viewTreatmentList()
 * @method LengthAwarePaginator prepareViewTreatmentPaginate(PaginateData $paginate_dto)
 * @method array viewTreatmentPaginate(?PaginateData $paginate_dto = null)
 * @method array storeTreatment(?TreatmentData $funding_dto = null)
 */
interface Treatment extends DataManagement
{
}
