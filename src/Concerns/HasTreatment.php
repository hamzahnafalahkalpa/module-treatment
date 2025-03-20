<?php

namespace Gilanggustina\Moduletreatment\Concerns;

trait HasTreatment {
    protected $__foreign_key = 'treatment_id';

    protected static function bootHasTreatment(){
        static::created(function($query){
            $treatment_parent = static::parentTreatment($query->parent_id);
            $parent_id = null;
            if($treatment_parent) $parent_id = $treatment_parent->getKey();

            $treatment = $query->treatment()->updateOrCreate([
                'parent_id'      => $parent_id,
                "reference_id"   => $query->id,
                "reference_type" => $query->getMorphClass()
            ],[
                'name' => $query->name
            ]);
            
            static::withoutEvents(function () use ($query, $treatment) {
                $treatment->treatment_code = $query->treatment_code;
                $treatment->price          = request()->price;
                $treatment->save();
            });
        });
        static::deleting(function($query){
            $query->treatment()->delete();
        });
        static::updated(function($query){
            $treatment_parent = static::parentTreatment($query->parent_id);
            $parent_id = null;
            if($treatment_parent) $parent_id = $treatment_parent->getKey();
            $treatment = $query->treatment()->updateOrCreate([
                'parent_id'         => $parent_id,
                "reference_id"      => $query->id,
                "reference_type"    => $query->getMorphClass()
            ],[
                'name' => $query->name,
            ]);
            static::withoutEvents(function () use ($query, $treatment) {
                $treatment->treatment_code = $query->treatment_code;
                $treatment->save();
            });
        });
    }

    protected static function parentTreatment($parent_id){
        if (isset($parent_id)){
            $parent = (new static)->find($parent_id)->load('treatment');
            return $parent->treatment;
        }
        return null;
    }

    public function initializeHasTreatment(){
        $this->mergeFillable([
            $this->__foreign_key
        ]);
    }

    //EIGER SECTION
    public function hasService(){
        $service_table = $this->ServiceModel()->getTableName();
        return $this->hasOneThroughModel(
            'Service',
            'ModelHasService',
            $service_table.'.reference_id',
            $this->ServiceModel()->getKeyName(),
            $this->getKeyName(),
            $this->ServiceModel()->getForeignKey()
        )->where($service_table.'.reference_type',$this->getMorphClass());
    }

    public function treatment(){
        return $this->morphOneModel('Treatment','reference');
    }

    public function treatments(){
        return $this->morphManyModel('Treatment','reference')->orderBy('name','asc');
    }

    public function service(){
        return $this->morphOneModel('Service','reference');
    }
    //END EIGER SECTION

}
