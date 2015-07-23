<?php

namespace Letsface\Platform;

class Postgresql
{
    const SUCCESSFUL_COMPLETION_CLASS = (string) \PDO::ERR_NONE;
    const SUCCESSFUL_COMPLETION = self::SUCCESSFUL_COMPLETION_CLASS;

    const WARNING_CLASS = '01000';
    const DYNAMIC_RESULT_SETS_RETURNED = '0100C';
    const implicit_zero_bit_padding = '01008';
}