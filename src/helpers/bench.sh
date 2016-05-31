#!/bin/bash
# yitsushi
number=$1
shift
executor=$1
shift

for f in $*; do
  echo "> ${executor} ${f}"
  time (for i in `seq $number`; do $executor $f > /dev/null; done;)
  echo
done
