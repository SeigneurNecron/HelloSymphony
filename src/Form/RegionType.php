<?php

namespace App\Form;

use App\Entity\Region;
use App\Form\Base\AbstractEntityType;
use App\Form\Trait\WithName;
use App\Form\Trait\WithSubmitButton;

/**
 * @template-extends AbstractEntityType<Region>
 */
class RegionType extends AbstractEntityType {

    use WithName, WithSubmitButton;

    public function __construct() {
        parent::__construct(Region::class);
    }

}
