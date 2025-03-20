<?php

namespace Hanafalah\ModuleTreatment\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Hanafalah\LaravelSupport\Contracts\DataManagement;

interface Treatment extends DataManagement
{
  public function treatment(mixed $conditionals = null): Builder;
  public function prepareViewTreatmentList(?array $attributes = null): Collection;
  public function prepareViewTreatmentPaginate(int $perPage = 10, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): LengthAwarePaginator;
  public function viewTreatmentPaginate(int $perPage = 10, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): array;
  public function viewTreatmentList(): array;
  public function getTreatments(): Collection;
  public function removeTreatmentById(): self;
}
