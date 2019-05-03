@echo off

cd ../../..
git checkout develop
git pull
composer update
php yii cache/flush-all

cd api
php "../vendor/codeception/base/codecept" run

pause