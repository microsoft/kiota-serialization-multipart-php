<?php

namespace Microsoft\Kiota\Serialization\Tests\Samples;

use Microsoft\Kiota\Abstractions\Enum;

class Gender extends Enum
{
    const MALE   = "male";
    const FEMALE = "female";
    const OTHER  = "other";
}