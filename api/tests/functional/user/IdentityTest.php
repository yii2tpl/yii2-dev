<?php

namespace tests\functional\user;

use api\tests\schemas\UserSchema;
use yii2lab\test\enums\TypeEnum;
use yii2lab\test\Test\BaseActiveApiTest;
use yii2module\account\domain\v3\helpers\test\AuthTestHelper;

class IdentityTest extends BaseActiveApiTest
{

    public $package = 'api';
    public $point = 'v1';
	
	public function testAll()
	{
		AuthTestHelper::authByLogin('admin');
		$this->readCollection('identity', [], UserSchema::$identity);
		
	}
	
	public function testAllByLogin()
	{
		AuthTestHelper::authByLogin('admin');
		$this->readCollection('identity', ['login' => 'admin'], UserSchema::$identity, 1);
	}
	
	public function testAllByLoginWithRelations()
	{
		AuthTestHelper::authByLogin('admin');
		$actual = $this->readCollection('identity', ['login' => 'admin', 'expand' => 'contacts,roles'], UserSchema::$identity);
		$this->tester->assertCollectionType([
			'roles' => TypeEnum::ARRAY,
			'contacts' => TypeEnum::ARRAY,
		], $actual);
	}
	
	public function testView()
	{
		AuthTestHelper::authByLogin('admin');
		$actual = $this->readEntity('identity', 1, UserSchema::$identity);
		$this->tester->assertEmpty($actual['roles']);
		$this->tester->assertEmpty($actual['contacts']);
	}
	
	public function testViewWithRelations()
	{
		AuthTestHelper::authByLogin('admin');
		$actual = $this->readEntity('identity', 1, UserSchema::$identity, ['expand' => 'contacts,roles']);
		$this->tester->assertArrayType([
			'roles' => TypeEnum::ARRAY,
			'contacts' => TypeEnum::ARRAY,
		], $actual);
	}
}
