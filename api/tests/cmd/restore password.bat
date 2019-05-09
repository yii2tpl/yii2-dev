@echo off
cd ../..
php "../vendor/codeception/base/codecept" run functional user/RestorePasswordTest.php
pause