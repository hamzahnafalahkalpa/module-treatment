<?php

namespace Hanafalah\ModuleTreatment\Models\Treatment;

use Hanafalah\ModuleService\Models\Service;
use Hanafalah\ModuleTreatment\Resources\Treatment\ShowTreatment;
use Hanafalah\ModuleTreatment\Resources\Treatment\ViewTreatment;

class Treatment extends Service
{
    protected $table = 'services';

    protected $casts = [
        'name' => 'string',
        'treatement_code' => 'string',
        'reference_service_label' => 'string',
        'reference_type' => 'string'
    ];

    public function getPropsQuery(): array
    {
        return [
            'treatment_code' => 'props->treatment_code',
            'reference_service_label' => 'props->prop_reference->prop_service_label->name'
        ];
    }

    protected static function booted(): void{
        parent::booted();
        static::addGlobalScope('is_treatment',function($query){
            $query->where('is_treatment',true);
        });
        static::creating(function ($query) {
            $query->treatment_code ??= static::hasEncoding('TREATMENT');
        });
        static::updated(function($query){
            if ($query->isDirty('status')){
                $query->load('childs');
                foreach ($query->childs as $child) {
                    $child->status = $query->status;
                    $child->save();
                }
            }
        });
    }

    public function getForeignKey(){
        return 'service_id';
    }

    public function getViewResource(){return ViewTreatment::class;}
    public function getShowResource(){return ShowTreatment::class;}
    public function hasService(){
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

    public function childs(){return $this->hasManyModel('Treatment', 'parent_id')->with('childs');}
}
