<?php

namespace Hanafalah\ModuleTreatment\Models\Treatment;

use Hanafalah\ModuleService\Models\Service;
use Hanafalah\ModuleTreatment\Resources\Treatment\ShowTreatment;
use Hanafalah\ModuleTreatment\Resources\Treatment\ViewTreatment;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\LaravelHasProps\Concerns\HasProps;

class Treatment extends Service
{
    use SoftDeletes, HasProps;

    protected $table = 'services';

    protected $casts = [
        'name'       => 'string',
    ];

    protected static function booted(): void
    {
        parent::booted();
        static::creating(function ($query) {
            if (!isset($query->treatment_code)) {
                $query->treatment_code = static::hasEncoding('TREATMENT');
            }
        });
    }

    public function getForeignKey()
    {
        return 'service_id';
    }

    public function toViewApi()
    {
        return new ViewTreatment($this);
    }

    public function toShowApi()
    {
        return new ShowTreatment($this);
    }

    public function hasService()
    {
        $service_model = $this->TreatmentModel();
        $service_table = $service_model->getTableName();
        return $this->hasOneThroughModel(
            'Service',
            'ModelHasService',
            $service_table . '.reference_id',
            $service_model->getKeyName(),
            $this->getKeyName(),
            $service_model->getForeignKey()
        )->where($service_table . '.reference_type', $this->getMorphClass());
    }

    public function childs()
    {
        return $this->hasManyModel('Treatment', 'parent_id')->with('childs');
    }
}
