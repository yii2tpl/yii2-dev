<?php

namespace tests\functional\user;

use api\tests\schemas\CompanySchema;
use api\tests\schemas\UserSchema;
use yii2lab\notify\domain\helpers\test\NotifyTestHelper;
use yii2lab\rest\domain\entities\RequestEntity;
use yii2lab\test\enums\TypeEnum;
use yii2lab\test\helpers\TestHelper;
use yii2lab\test\Test\BaseActiveApiTest;
use yii2module\account\domain\v3\helpers\test\AuthTestHelper;
use yii2module\account\domain\v3\helpers\test\CurrentPhoneTestHelper;
use yii2module\account\domain\v3\helpers\test\RegistrationTestHelper;
use yii2rails\extension\web\enums\HttpMethodEnum;
use yii2rails\extension\yii\helpers\FileHelper;

class RegistrationTest extends BaseActiveApiTest
{

    const PASSWORD = 'Wwwqqq111';
	const EXISTS_PHONE = '77771111111';

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
	
	public function getLastPhone()
	{
		$phone = RegistrationTestHelper::getlastPhone();
		CurrentPhoneTestHelper::set($phone);
	}
	
	public function testRequestActivationCodeExistsPhone() {
		$this->createEntityUnProcessible('registration/request-activation-code', [
			'phone' => self::EXISTS_PHONE,
		], ['phone']);
	}
 
	public function testRequestActivationCode() {
        $phone = RegistrationTestHelper::getlastPhone();
        $this->createEntity('registration/request-activation-code', [
            'phone' => $phone,
        ]);
    }

    public function testVerifyActivationCode() {
        $phone = CurrentPhoneTestHelper::get();
        $code = NotifyTestHelper::getActivationCodeByPhone($phone);
        $requestEntity = new RequestEntity;
        $requestEntity->uri = 'registration/verify-activation-code';
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
        $this->createEntityUnProcessible('registration/verify-activation-code', [
            'phone' => $phone,
            'activation_code' => '123456',
        ], ['activation_code']);
    }

    public function testVerifyActivationCodeBadPhone() {
        $this->createEntityUnProcessible('registration/verify-activation-code', [
            'phone' => '77772222222',
            'activation_code' => '111111',
        ], ['phone']);
    }
	
	public function testCreateAccountExistsLogin() {
		$phone = CurrentPhoneTestHelper::get();
		$code = NotifyTestHelper::getActivationCodeByPhone($phone);
		$this->createEntityUnProcessible('registration/create-account', [
			'phone' => $phone,
			'activation_code' => $code,
			'password' => self::PASSWORD,
			'login' => 'tester1',
			'first_name' => 'Name',
			'last_name' => 'Family',
			'middle_name' => 'Middle',
			'birthday' => '2018-03-20',
		], ['login']);
	}
    
    public function testCreateAccount() {
        $phone = CurrentPhoneTestHelper::get();
        $code = NotifyTestHelper::getActivationCodeByPhone($phone);
        $this->createEntity('registration/create-account', [
            'phone' => $phone,
            'activation_code' => $code,
            'password' => self::PASSWORD,
            'login' => 'test' . $phone,
            'first_name' => 'Name',
            'last_name' => 'Family',
            'middle_name' => 'Middle',
            'birthday' => '2018-03-20',
        ]);
        $this->checkAuth($phone, self::PASSWORD);
    }

    public function testCreateAccountByAdmin() {
        AuthTestHelper::authByLogin('admin');

        $phone = RegistrationTestHelper::getlastPhone();
        CurrentPhoneTestHelper::set($phone);

        $this->createEntity('registration/create-account', [
            'phone' => $phone,
            //'activation_code' => '111111',
            'password' => self::PASSWORD,
            'login' => 'test' . $phone,
            'first_name' => 'Name',
            'last_name' => 'Family',
            //'middle_name' => 'Middle',
            'birthday' => '2018-03-20',
        ]);
        $this->checkAuth($phone, self::PASSWORD);
    }

}
