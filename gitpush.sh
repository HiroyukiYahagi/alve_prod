#!/bin/bash

if [ $# -eq 0 ]; then
  echo "please input comment"
  exit -1
fi

sudo git add ./*
sudo git commit -m "$@"
sudo git push origin master

URL=tk2-245-32227.vs.sakura.ne.jp

ssh alve@$URL "/home/alve/source/alve_prod/deploy.sh"

