<?php

namespace Gilanggustina\ModuleTreatment\Schemas;

use Hanafalah\ModuleService\Schemas\Service;
use Illuminate\Database\Eloquent\Builder;
use Gilanggustina\ModuleTreatment\Contracts;
use Illuminate\Database\Eloquent\Collection;
use Gilanggustina\ModuleTreatment\Resources\Treatment\{
    ViewTreatment,
    ShowTreatment
};
use Illuminate\Pagination\LengthAwarePaginator;

class Treatment extends Service implements Contracts\Treatment
{
    protected string $__entity = 'Treatment';
    protected static $treatment_model;

    protected array $__resources = [
        'view' => ViewTreatment::class,
        'show' => ShowTreatment::class
    ];

    public function treatment(mixed $conditionals = null): Builder
    {
        $this->booting();
        return $this->TreatmentModel()->withParameters('or')
            ->conditionals($conditionals)
            ->orderBy('name', 'asc');
    }

    public function prepareViewTreatmentList(?array $attributes = null): Collection
    {
        $attributes ??= request()->all();
        return static::$treatment_model = $this->treatment()
            ->conditionals($this->mergeCondition([]))
            ->when(isset($attributes['reference_type']), function ($query) use ($attributes) {
                $query->where('reference_type', $attributes['reference_type']);
            })
            ->when(isset($attributes['is_parent_null']), function ($query) {
                $query->whereNull('parent_id');
            })
            ->get();
    }

    public function prepareViewTreatmentPaginate(int $perPage = 10, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): LengthAwarePaginator
    {
        $attributes ??= request()->all();
        $paginate_options = compact('perPage', 'columns', 'pageName', 'page', 'total');
        return static::$treatment_model = $this->treatment()
            ->conditionals($this->mergeCondition([]))
            ->when(isset($attributes['reference_type']), function ($query) use ($attributes) {
                $reference_type = $this->mustArray($attributes['reference_type']);
                $query->whereIn('reference_type', $reference_type);
            })
            ->when(isset($attributes['is_parent_null']), function ($query) {
                $query->whereNull('parent_id');
            })
            ->paginate(
                ...$this->arrayValues($paginate_options)
            )->appends(request()->all());
    }

    public function viewTreatmentPaginate(int $perPage = 10, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): array
    {
        $paginate_options = compact('perPage', 'columns', 'pageName', 'page', 'total');
        return $this->transforming($this->__resources['view'], function () use ($paginate_options) {
            return $this->prepareViewTreatmentPaginate(...$this->arrayValues($paginate_options));
        });
    }

    public function viewTreatmentList(): array
    {
        return $this->transforming($this->__resources['view'], function () {
            return $this->prepareViewTreatmentList();
        });
    }

    public function getTreatments(): Collection
    {
        return $this->treatment(function ($query) {
            if (request()->has('search_name')) {
                $query->whereLike('name', request()->name);
            }
        })->get();
    }

    public function removeTreatmentById(): self
    {
        $this->treatment()->removeById();
        return $this;
    }
}
