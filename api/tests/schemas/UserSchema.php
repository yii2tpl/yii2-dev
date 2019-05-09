<?php

namespace api\tests\schemas;

use yii2lab\test\enums\TypeEnum;

class UserSchema
{

    public static $identity = [
        'id' => TypeEnum::INTEGER,
        'login' => TypeEnum::STRING,
        'status' => TypeEnum::INTEGER,
        'roles' => [TypeEnum::ARRAY, TypeEnum::NULL],
        'token' => [TypeEnum::STRING, TypeEnum::NULL],
        //'person_id' => TypeEnum::INTEGER,
        //'company_id' => TypeEnum::INTEGER,
        //'person' => [TypeEnum::ARRAY, TypeEnum::NULL],
        //'company' => [TypeEnum::ARRAY, TypeEnum::NULL],
    ];

    public static $person = [
        'id' => TypeEnum::INTEGER,
        'first_name' => TypeEnum::STRING,
        'last_name' => TypeEnum::STRING,
        'middle_name' => [TypeEnum::STRING, TypeEnum::NULL],
        'email' => TypeEnum::STRING,
        'phone' => TypeEnum::STRING,
        'birthday' => TypeEnum::STRING,
        //'worker' => TypeEnum::NULL,
        //'user' => TypeEnum::NULL,
        'status' => TypeEnum::INTEGER,
        'full_name' => TypeEnum::STRING,
        'initial' => TypeEnum::STRING,
    ];

}
