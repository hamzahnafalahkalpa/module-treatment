<?php

namespace Hanafalah\Moduletreatment\Concerns;

use Hanafalah\LaravelSupport\Concerns\Support\HasRequestData;

trait HasTreatment
{
    use HasRequestData;

    // protected $__foreign_key = 'treatment_id';

    protected static function bootHasTreatment()
    {
        static::deleting(function ($query) {
            $query->treatment()->delete();
        });
    }

    // public function initializeHasTreatment(){
    //     $this->mergeFillable([
    //         $this->__foreign_key
    //     ]);
    // }

    public function getPropsQuery(): array{
        return [
            'treatment_code' => 'props->prop_treatment->treatment_code',
            'service_label_name'  => 'props->prop_service_label->name'
        ];
    }

    public function viewUsingRelation():array{
        return [];
    }

    public function showUsingRelation():array{
        return [
            'medicalServiceTreatments',
            'treatment.servicePrices'
        ];
    }

    //EIGER SECTION
    public function hasService()
    {
        $service_table = $this->ServiceModel()->getTableName();
        return $this->hasOneThroughModel(
            'Service',
            'ModelHasService',
            $service_table . '.reference_id',
            $this->ServiceModel()->getKeyName(),
            $this->getKeyName(),
            $this->ServiceModel()->getForeignKey()
        )->where($service_table . '.reference_type', $this->getMorphClass());
    }

    public function treatment(){return $this->morphOneModel('Treatment', 'reference');}
    public function treatments(){return $this->morphManyModel('Treatment', 'reference')->orderBy('name', 'asc');}
    public function service(){return $this->morphOneModel('Service', 'reference');}
    public function medicServices(){
        return $this->belongsToManyModel(
            'MedicService',
            'MedicalServiceTreatment',
            'medical_treatment_id',
            'medic_service_id'
        );
    }
    //END EIGER SECTION

}
