<?php

namespace api\tests\schemas;

use yii2lab\test\enums\TypeEnum;

class CompanySchema
{

    public static $company = [
        'id' => TypeEnum::INTEGER,
        'code' => TypeEnum::INTEGER,
        'name' => TypeEnum::STRING,
        'status' => TypeEnum::INTEGER,
        'created_at' => TypeEnum::TIME,
        'updated_at' => TypeEnum::TIME,
        //'domains' => TypeEnum::NULL,
    ];

}
