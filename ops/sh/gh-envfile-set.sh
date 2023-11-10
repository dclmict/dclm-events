#!/bin/bash

env_src="./src/.env"
ga_file1="deploy.yml"
ga_file2="deploy_new.yml"
ga_dir="./.github/workflows"
ga="$ga_dir/$ga_file1"
ga_new="$ga_dir/$ga_file2"

# Delete vars.txt if it exists
if [ -f vars.txt ]; then
  rm vars.txt
fi
## read and extract variable names from .env file into text file
# List of keys to exclude
exclude=(
  DL_AWS_KEY
  DL_AWS_SECRET
  DL_HOSTED_ZONE_ID
  DL_SERVER_IP
  DL_APP_URL
  DL_APP_PROXY_URL
  DL_APP_DIR
  DL_URL1
  DL_URL2
  DL_URL3
  DL_SSH_HOST
  DL_SSH_USERNAME
  DL_GIT_BRANCH
  DL_ENV_FILE
  DL_ENV_SRC
  DL_ENV_DEST
  DL_WORK_DIR
  DL_NGINX_CONF_FILE
  DL_NGINX_CONF_DIR
  DL_VHOST_CONFIG
  DL_SSH_KEY
)

# Read .env file
while IFS= read -r kv; do

  # Extract the key
  key=$(echo "$kv" | cut -d= -f1)

  # Check if key is excluded
  if [[ " ${exclude[@]} " =~ " $key " ]]; then
    continue
  fi

  # Copy key if not excluded
  if [[ $key != "" && $key != "#"* ]]; then
    echo "$key" >> vars.txt
  fi

done < <(grep '=' $env_src)

# Load variables from vars.txt
while read -r var; do
  vars+=($var)
done < vars.txt

# Find the Generate envfile step 
envfile_line=$(grep -n "uses: SpicyPizza/create-envfile@v2.0" $ga | cut -d: -f1)
envfile_line=$((envfile_line+1))
tail_line=$(grep -n "directory: \${{ env.ENV_SRC }}" $ga | cut -d: -f1)


# Generate new file with variables
{
  head -n $((envfile_line)) $ga

  for var in "${vars[@]}"; do
    echo "          envkey_$var: \${{ secrets.$var }}" 
  done

  tail -n +$((tail_line)) $ga

} > $ga_new

# Overwrite original 
mv $ga_new $ga
rm -f vars.txt
echo -e "Worklow updated successfully!\n"
