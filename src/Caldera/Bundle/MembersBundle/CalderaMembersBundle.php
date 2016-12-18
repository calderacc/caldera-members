<?php

namespace Caldera\Bundle\MembersBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CalderaMembersBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
