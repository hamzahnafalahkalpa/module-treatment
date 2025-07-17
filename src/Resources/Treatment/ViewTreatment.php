<?php

namespace Hanafalah\ModuleTreatment\Resources\Treatment;

use Hanafalah\ModuleService\Resources\ViewService;

class ViewTreatment extends ViewService
{

    /**
     * Transform the resource into an array.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [];
        $arr = $this->mergeArray(parent::toArray($request), $arr);
        return $arr;
    }
}
