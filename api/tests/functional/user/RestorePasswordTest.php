<?php

namespace tests\functional\user;

use yii2lab\notify\domain\helpers\test\NotifyTestHelper;
use yii2lab\rest\domain\entities\RequestEntity;
use yii2lab\test\helpers\TestHelper;
use yii2lab\test\Test\BaseActiveApiTest;
use yii2module\account\domain\v3\helpers\test\CurrentPhoneTestHelper;
use yii2module\account\domain\v3\helpers\test\RegistrationTestHelper;
use yii2rails\extension\web\enums\HttpMethodEnum;
use yii2rails\extension\yii\helpers\FileHelper;

class RestorePasswordTest extends BaseActiveApiTest
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

    public function testClearSms()
    {
        NotifyTestHelper::cleanSms();
    }

    public function testCreateUser()
    {
        RegistrationTestHelper::registration();
    }

    public function testRequestActivationCode() {
        $phone = CurrentPhoneTestHelper::get();
        $this->createEntity('restore-password/request-activation-code', [
            'phone' => $phone,
        ]);
        $this->createEntityUnProcessible('restore-password/request-activation-code', [
            'phone' => $phone,
        ], ['phone']);
    }

    public function testVerifyActivationCode() {
        $phone = CurrentPhoneTestHelper::get();
        $code = NotifyTestHelper::getActivationCodeByPhone($phone);
        $requestEntity = new RequestEntity;
        $requestEntity->uri = 'restore-password/verify-activation-code';
        $requestEntity->method = HttpMethodEnum::POST;
        $requestEntity->data = [
            'phone' => $phone,
            'activation_code' => $code,
        ];
        $responseEntity = $this->sendRequest($requestEntity);
        $this->tester->assertEquals(204, $responseEntity->status_code);
    }

    public function testVerifyActivationCodeBadCode() {
        $phone = CurrentPhoneTestHelper::get();
        $this->createEntityUnProcessible('restore-password/verify-activation-code', [
            'phone' => $phone,
            'activation_code' => '123456',
        ], ['activation_code']);
    }

    public function testCreateAccount() {
        $phone = CurrentPhoneTestHelper::get();
        $code = NotifyTestHelper::getActivationCodeByPhone($phone);
        $this->createEntity('restore-password/set-password', [
            'phone' => $phone,
            'activation_code' => $code,
            'password' => self::NEW_PASSWORD,
        ]);
        /*$this->createEntityUnProcessible('restore-password/set-password', [
            'phone' => $phone,
            'activation_code' => $code,
            'password' => self::NEW_PASSWORD,
        ], ['phone']);*/
        $this->checkAuth($phone, self::NEW_PASSWORD);
    }

}
