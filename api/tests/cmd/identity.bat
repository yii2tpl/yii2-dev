@echo off
cd ../..
php "../vendor/codeception/base/codecept" run functional user/IdentityTest.php
pause