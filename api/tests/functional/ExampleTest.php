<?php

namespace tests\functional;

use yii2lab\notify\domain\helpers\test\NotifyTestHelper;
use yii2lab\rest\domain\entities\RequestEntity;
use yii2lab\test\enums\TypeEnum;
use yii2lab\test\helpers\CurrentIdTestHelper;
use yii2lab\test\helpers\TestHelper;
use yii2lab\test\Test\BaseActiveApiTest;
use yii2rails\extension\web\enums\HttpMethodEnum;
use yii2rails\extension\yii\helpers\FileHelper;
use yubundle\account\domain\v2\helpers\test\RegistrationTestHelper;

/*
Configure env-local.php:
'test' => [
    'skipBug' => true, // скрывать кейсы, помеченные как баг
],
 */

class ExampleTest extends BaseActiveApiTest
{

    private $exampleSchema = [
        'id' => TypeEnum::INTEGER,
    ];

    public function _testLoadFixture()
    {
        TestHelper::copySqlite(FileHelper::up(__DIR__), false);
    }

    public function _testClearSms()
    {
        NotifyTestHelper::cleanSms();
    }

    public function _testCreateUser()
    {
        RegistrationTestHelper::registration();
    }

    public function _testCreate() {
        $this->authByNewUser();
        $this->createEntity('example', [
            'param1' => 'value1',
            'param2' => 'value2',
        ], true);
    }

    public function _testCreateFail() {
        $this->authByNewUser();
        $this->createEntityUnProcessible('example', [
            'param1' => 'value1',
            'param2' => 'value2',
        ], ['param1']);
    }

    public function _testAll()
    {
        $this->authByNewUser();
        $actual = $this->readCollection('example', [], $this->exampleSchema, 1);
    }

    public function _testView()
    {
        $id = CurrentIdTestHelper::get();
        $this->authByNewUser();
        $actual = $this->readEntity('example', $id, $this->exampleSchema);
        $this->tester->assertArraySubset([
            'param1' => 'value1',
        ], $actual);

        $this->tester->assertValueType(TypeEnum::STRING, $actual['field1']);
        $this->tester->assertArrayType(UserSchema::$person, $actual['field2']);
    }

    public function _testViewNotFound()
    {
        $id = CurrentIdTestHelper::get();
        $this->authByNewUser();
        $this->readNotFoundEntity('example', $id);
    }

    public function _testUpdate()
    {
        $id = CurrentIdTestHelper::get();
        $this->authByNewUser();
        $this->updateEntity('example', $id, [
            'param1' => 'value1',
            'param2' => 'value2',
        ]);
    }

    public function _testDelete()
    {
        $id = CurrentIdTestHelper::get();
        $this->authByNewUser();
        $this->deleteEntity('example', $id);
    }

    public function _testCustomCreate()
    {
        $this->authByNewUser();
        $requestEntity = new RequestEntity;
        $requestEntity->uri = 'example';
        $requestEntity->method = HttpMethodEnum::POST;
        $requestEntity->data = [
            'param1' => 'value1',
        ];
        $responseEntity = $this->sendRequest($requestEntity);
        $this->tester->assertEquals(201, $responseEntity->status_code);
    }

    public function _testSkipBug()
    {
        if(TestHelper::isSkipBug()) return; // если всключен тихий режим, то код ниже не будет выполнен
    }

    public function _testPrintMessage()
    {
        TestHelper::printMessage('вывести сообщение');
    }
}
