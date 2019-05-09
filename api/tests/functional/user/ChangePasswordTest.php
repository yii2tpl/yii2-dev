<?php

namespace tests\functional\user;

use yii2lab\rest\domain\entities\RequestEntity;
use yii2lab\test\helpers\TestHelper;
use yii2lab\test\Test\BaseActiveApiTest;
use yii2module\account\domain\v3\helpers\test\AuthTestHelper;
use yii2module\account\domain\v3\helpers\test\CurrentPhoneTestHelper;
use yii2module\account\domain\v3\helpers\test\RegistrationTestHelper;
use yii2rails\extension\web\enums\HttpMethodEnum;
use yii2rails\extension\yii\helpers\FileHelper;

class ChangePasswordTest extends BaseActiveApiTest
{

    const PHONE = '7777111111';
    const PASSWORD = 'Wwwqqq111';
    const NEW_PASSWORD = 'Wwwqqq222';

    public $package = 'api';
    public $point = 'v1';

    public function testLoadFixture()
    {
        TestHelper::copySqlite(FileHelper::up(__DIR__), false);
    }

    public function testCreateUser()
    {
        RegistrationTestHelper::registration();
    }

    public function testChangePassword() {
        $phone = CurrentPhoneTestHelper::get();
        AuthTestHelper::authByLogin('test' . $phone);

        $requestEntity = new RequestEntity;
        $requestEntity->uri = 'security/password';
        $requestEntity->method = HttpMethodEnum::PUT;
        $requestEntity->data = [
            'password' => self::PASSWORD,
            'new_password' => self::NEW_PASSWORD,
        ];
        $responseEntity = $this->sendRequest($requestEntity);
        $this->tester->assertEquals(204, $responseEntity->status_code);
        $this->checkAuth($phone, self::NEW_PASSWORD);
    }

}
