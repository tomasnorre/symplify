<?php

declare(strict_types=1);

namespace Symplify\PHPStanRules\ValueObject;

final class MethodName
{
    /**
     * @var string
     */
    public const CONSTRUCTOR = '__construct';

    /**
     * @var string
     */
    public const SET_UP = 'setUp';
}
