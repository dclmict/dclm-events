#!/bin/bash

# check if argument is more than 1
if [ $# -ne 1 ]; then
  echo "Usage: $(basename "$0") <repository>"
  exit 1
fi

# check if repo exists
repo=$1
code1=200
code2=404
status_code=$(curl -o /dev/null -s -w "%{http_code}\n" https://github.com/$repo)

# if condition
if [ $status_code -eq 200 ]; then
  echo $code1
elif [ $status_code -eq 404 ]; then
  echo $code2
else
  echo "Status code: $status_code" >&2
  exit 1
fi
