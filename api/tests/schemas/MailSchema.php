<?php

namespace api\tests\schemas;

use yii2lab\test\enums\TypeEnum;

class MailSchema
{

    public static $flow = [
        'id' => TypeEnum::INTEGER,
        'direct' => TypeEnum::STRING,
        'mail_address' => TypeEnum::STRING,
        'mail_id' => TypeEnum::INTEGER,
        'read_at' => [TypeEnum::TIME, TypeEnum::NULL],
        'status' => TypeEnum::INTEGER,
        'seen' => TypeEnum::BOOLEAN,
        'flagged' => TypeEnum::BOOLEAN,
        'folder' => TypeEnum::STRING,
        'from' => TypeEnum::STRING,
        'to' => TypeEnum::ARRAY,
        'subject' => TypeEnum::STRING,
        'short_content' => TypeEnum::STRING,
        'content' => TypeEnum::STRING,
        'attachments' => [TypeEnum::ARRAY, TypeEnum::NULL],
        'has_attachment' => TypeEnum::BOOLEAN,
        'has_attachments' => TypeEnum::BOOLEAN,
        'created_at' => TypeEnum::TIME,
        'updated_at' => TypeEnum::TIME,
    ];

    public static $mail = [
        'id' => TypeEnum::INTEGER,
        'kind' => TypeEnum::STRING,
        'type' => TypeEnum::STRING,
        'from' => TypeEnum::STRING,
        // todo: return for postgres // 'to' => TypeEnum::ARRAY,
        'copy_to' => [TypeEnum::ARRAY, TypeEnum::NULL],
        'subject' => TypeEnum::STRING,
        'content' => TypeEnum::STRING,
        'is_draft' => TypeEnum::BOOLEAN,
        'status' => TypeEnum::INTEGER,
        'created_at' => TypeEnum::TIME,
        'updated_at' => TypeEnum::TIME,
        'attachments' => [TypeEnum::ARRAY, TypeEnum::NULL],
    ];

    public static $attachment = [
        'id' => TypeEnum::INTEGER,
        'mail_id' => TypeEnum::INTEGER,
        'path' => TypeEnum::STRING,
        'extension' => [TypeEnum::STRING, TypeEnum::NULL],
        'size' => TypeEnum::INTEGER,
        'status' => TypeEnum::INTEGER,
        'created_at' => TypeEnum::TIME,
        'updated_at' => TypeEnum::TIME,
        'url' => TypeEnum::STRING,
        'file_name' => TypeEnum::STRING,
    ];
}
