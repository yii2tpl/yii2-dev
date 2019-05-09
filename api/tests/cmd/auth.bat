@echo off
cd ../..
php "../vendor/codeception/base/codecept" run functional user/AuthTest.php
pause