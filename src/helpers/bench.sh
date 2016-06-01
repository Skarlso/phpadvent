#!/bin/bash
# yitsushi
# ./bench.sh 100 php part1.php part1_v2.php
number=$1
shift
executor=$1
shift

for f in $*; do
  echo "> ${executor} ${f}"
  time (for i in `seq $number`; do $executor $f > /dev/null; done;)
  echo
done
