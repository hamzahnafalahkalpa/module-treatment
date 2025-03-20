    <?php

namespace Gilanggustina\ModuleTreatment\Schemas;

use Gilanggustina\ModuleTreatment\{
    Supports\BaseModuleTreatment
};
use Gilanggustina\ModuleTreatment\Contracts\Treatment as ContractsTreatment;

class Treatment extends BaseModuleTreatment implements ContractsTreatment{
    protected array $__guard   = ['id', 'uuid','reference_id','reference_type']; 
    protected array $__add     = ['name','status'];
    protected string $__entity = 'Service';

    public function booting(): self{
        static::$__class = $this;
        static::$__model = $this->{$this->__entity."Model"}();
        return $this;
    }

    /**
     * Add a new API access or update the existing one if found.
     *
     * The given attributes will be merged with the existing API access.
     *
     * @param array $attributes The attributes to be added to the API access.
     *
     * @return \Illuminate\Database\Eloquent\Model The API access model.
     */
    public function addOrChange(? array $attributes=[]): self{    
        $this->updateOrCreate($attributes);            
        return $this;
    }



    // [
    //   'service' => [
    //     'service_name' => 'Paket Gold',
    //     'flag'  => $this->getFlag(),
    //     'service_price' => [
    //       'price' => 20000
    //     ],
    //     'service_items' => [
    //       [
    //         'service_id' => 1, 
    //         'service_items' => [
    //           ['id' => 2] //bisa lab, bisa radiologi, bisa treatment
    //         ],
    //       ]
    //     ]
    //   ]
    // ];
}

// PAKET GOLD
//   -> VISIT MCU
//   -> VISIT RAD
//      -> XRAY
//   -> VISIT LAB
//      -> SGOT
//      -> SGPT

