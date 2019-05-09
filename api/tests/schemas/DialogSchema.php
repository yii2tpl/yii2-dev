<?php

namespace api\tests\schemas;

use yii2lab\test\enums\TypeEnum;

class DialogSchema
{

    public static $dialog = [
        'id' => TypeEnum::INTEGER,
        'actor' => TypeEnum::STRING,
        'contractor' => TypeEnum::STRING,
        'created_at' => TypeEnum::TIME,
        'updated_at' => TypeEnum::TIME,
        'status' => TypeEnum::INTEGER,
        'last_message' => [TypeEnum::STRING,TypeEnum::NULL],
        'new_message_count' => TypeEnum::INTEGER,
        'flagged' => TypeEnum::BOOLEAN,
        // todo: hold 'box' => TypeEnum::STRING,
        // todo: hold 'mails' => TypeEnum::STRING,
        'full_name' => TypeEnum::STRING ,
        'post_name' => [TypeEnum::STRING,TypeEnum::NULL],
        'division_name' => [TypeEnum::STRING,TypeEnum::NULL],
    ];

}
