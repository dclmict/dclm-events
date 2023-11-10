#!/bin/bash

# Check that an env file argument was provided
if [ $# -ne 1 ]; then
  echo "Usage: $0 <envfile>"
  exit 1
fi

# Assign the env file argument to a variable
envfile="$1"

# Validate that the env file exists
if [ ! -f "$envfile" ]; then
  echo "Error: Env file '$envfile' not found"
  exit 1
fi

# Run gh secret set, reading from the env file 
gh secret set -f "$envfile"

# Check return code and output result
if [ $? -eq 0 ]; then
  echo "Secrets set successfully from '$envfile'"
else
  echo "Error setting secrets from '$envfile'"
  exit 1
fi