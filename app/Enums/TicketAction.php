<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class TicketAction
 * @package App\Enums
 */
final class TicketAction extends Enum
{
    const Created =   1;
    const Updated =   2;
    const Deleted =   3;
}
