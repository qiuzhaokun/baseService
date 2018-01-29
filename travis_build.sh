#!/bin/bash
projectDir = /webroot/api.base.myexist.cn/
configDir = /webroot/config/base/
cd $projectDir
git pull origin master
mv .env.prod .env
chown -R nginx:nginx $projectDir
chmod -R 755 $projectDir
rm -rf $projectDir/config
cp $configDir $projectDir
echo 'travis build done!'