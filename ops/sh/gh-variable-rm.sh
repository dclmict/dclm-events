#!/bin/bash

# Source the .env file to load environment variables
source ./src/.env

# Extract the VHOST_CONFIG variable
VHOST_CONFIG=${DL_VHOST_CONFIG}

# Save the VHOST_CONFIG to env.txt
file=./env.txt
echo "$VHOST_CONFIG" > "$file"

# set environment variable using 'gh' CLI
# gh variable set NGX -b "$(cat $file)"
gh variable delete NGX < "$file"

rm -f "$file"