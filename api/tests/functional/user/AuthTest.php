<?php

namespace tests\functional\user;

use api\tests\schemas\CompanySchema;
use api\tests\schemas\UserSchema;
use yii2lab\rest\domain\entities\RequestEntity;
use yii2lab\test\enums\TypeEnum;
use yii2lab\test\helpers\TestHelper;
use yii2lab\test\Test\BaseActiveApiTest;
use yii2module\account\domain\v3\helpers\test\AuthTestHelper;
use yii2rails\extension\web\enums\HttpMethodEnum;
use yii2rails\extension\yii\helpers\FileHelper;

class AuthTest extends BaseActiveApiTest
{

    public $package = 'api';
    public $point = 'v1/auth';

    public function testLoadFixture()
    {
        TestHelper::copySqlite(FileHelper::up(__DIR__), false);
    }

	public function testGuest()
	{
        AuthTestHelper::logout();

        $requestEntity = new RequestEntity;
        $requestEntity->method = HttpMethodEnum::GET;
        $responseEntity = $this->sendRequest($requestEntity);
        $this->tester->assertEquals(401, $responseEntity->status_code);
	}

    public function testAuthByPhone()
    {
        AuthTestHelper::logout();

        $requestEntity = new RequestEntity;
        $requestEntity->method = HttpMethodEnum::POST;
        $requestEntity->data = [
            'login' => '77771111111',
            'password' => 'Wwwqqq111',
        ];
        $responseEntity = $this->sendRequest($requestEntity);
        $this->tester->assertEquals(200, $responseEntity->status_code);
        $actual = $responseEntity->data;
        $this->tester->assertArrayType(UserSchema::$identity, $actual);
        $this->tester->assertValueType(TypeEnum::ARRAY, $actual['roles']);
        $this->tester->assertValueType(TypeEnum::STRING, $actual['token']);
        //$this->tester->assertArrayType(UserSchema::$person, $actual['person']);
        //$this->tester->assertArrayType(CompanySchema::$company, $actual['company']);
    }

    public function testAuthByLogin()
    {
        AuthTestHelper::logout();

        $requestEntity = new RequestEntity;
        $requestEntity->method = HttpMethodEnum::POST;
        $requestEntity->data = [
            'login' => 'admin',
            'password' => 'Wwwqqq111',
        ];
        $responseEntity = $this->sendRequest($requestEntity);
        $this->tester->assertEquals(200, $responseEntity->status_code);
        $actual = $responseEntity->data;
        $this->tester->assertArrayType(UserSchema::$identity, $actual);
        $this->tester->assertValueType(TypeEnum::ARRAY, $actual['roles']);
        $this->tester->assertValueType(TypeEnum::STRING, $actual['token']);
        //$this->tester->assertArrayType(UserSchema::$person, $actual['person']);
        //$this->tester->assertArrayType(CompanySchema::$company, $actual['company']);
    }

    public function testAuthByEmail()
    {
        AuthTestHelper::logout();

        $requestEntity = new RequestEntity;
        $requestEntity->method = HttpMethodEnum::POST;
        $requestEntity->data = [
            'login' => 'admin@example.com',
            'password' => 'Wwwqqq111',
        ];
        $responseEntity = $this->sendRequest($requestEntity);
        $this->tester->assertEquals(200, $responseEntity->status_code);
        $actual = $responseEntity->data;
        $this->tester->assertArrayType(UserSchema::$identity, $actual);
        $this->tester->assertValueType(TypeEnum::ARRAY, $actual['roles']);
        $this->tester->assertValueType(TypeEnum::STRING, $actual['token']);
        //$this->tester->assertArrayType(UserSchema::$person, $actual['person']);
        //$this->tester->assertArrayType(CompanySchema::$company, $actual['company']);
    }

    public function testInfoAdmin()
    {
        AuthTestHelper::authByLogin('admin');

        $requestEntity = new RequestEntity;
        $requestEntity->method = HttpMethodEnum::GET;
        $responseEntity = $this->sendRequest($requestEntity);
        $this->tester->assertEquals(200, $responseEntity->status_code);
        $actual = $responseEntity->data;
        $this->tester->assertArrayType(UserSchema::$identity, $actual);
        $this->tester->assertValueType(TypeEnum::ARRAY, $actual['roles']);
        $this->tester->assertValueType(TypeEnum::NULL, $actual['token']);
    }

    public function testInfoTester1()
    {
        AuthTestHelper::authByLogin('tester1');

        $requestEntity = new RequestEntity;
        $requestEntity->method = HttpMethodEnum::GET;
        $responseEntity = $this->sendRequest($requestEntity);
        $this->tester->assertEquals(200, $responseEntity->status_code);
        $actual = $responseEntity->data;
        $this->tester->assertArrayType(UserSchema::$identity, $actual);
        $this->tester->assertValueType(TypeEnum::NULL, $actual['token']);
    }

}
