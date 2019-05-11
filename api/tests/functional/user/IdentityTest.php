<?php

namespace tests\functional\user;

use api\tests\schemas\UserSchema;
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
	
	public function testView()
	{
		AuthTestHelper::authByLogin('admin');
		$this->readEntity('identity', 2, UserSchema::$identity);
	}
}
