#!/bin/bash

pidfile=/tmp/ploy.pid
if [ -f $pidfile ]
then
  pid=`cat $pidfile`
  running=`ps auxw | awk '{print $2}' | grep $pid | wc -l`
  if [ $running eq 1 ]
  then
    exit
  fi
fi

echo $$ > $pidfile
echo "Starting Ploy queue"

while true
do 
  date
  php artisan queue:listen --verbose --timeout 100
done

