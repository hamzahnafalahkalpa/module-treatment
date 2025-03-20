<?php

namespace Gilanggustina\ModuleTreatment\Enums\Treatment;

enum TreatmentStatus: int{
    case DRAFT    = 0;
    case ACTIVE   = 1;
    case INACTIVE = 2;
}