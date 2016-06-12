#!/bin/bash

if [ $# -eq 0 ]; then
  echo "please input comment"
  exit -1
fi

sudo git add ./*
sudo git commit -m "$@"
sudo git push origin master


#ssh root@ik1-305-12678.vs.sakura.ne.jp "~/work/alve_deploy.sh"

