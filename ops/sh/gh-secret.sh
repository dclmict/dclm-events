#!/bin/bash

gh_secret_private() {
  # Run gh secret set, reading from the env file 
  gh secret set -f "$envfile"

  # Check return code and output result
  if [ $? -eq 0 ]; then
    echo -e "Secrets set successfully\n"
  else
    echo -e "Error setting secrets\n"
    exit 1
  fi
}

gh_secret_private_rm() {
  # Initialize the ARGS array
  ARGS=()

  while IFS= read -r line; do
    # Check if the line is not empty and does not start with '#'
    if [ -n "$line" ] && [[ ! "$line" =~ ^\# ]]; then
      # Extract the variable name (part before the '=' sign)
      var_name=$(echo "$line" | cut -d'=' -f1)
      ARGS+=("$var_name")
    fi
  done < "$envfile"
  parallel --retries 3 --silent -j+0 gh secret delete ::: "${ARGS[@]}"

  # Check return code and output result
  if [ $? -eq 0 ]; then
    echo -e "Secrets deleted successfully\n"
  else
    echo -e "Error deleting secrets\n"
    exit 1
  fi
}

gh_secret_public() {
  # Check the DL_ENV_ENV variable
  if [ "$DL_ENV_ENV" = "dclm-prod" ]; then
    env="prod"
  elif [ "$DL_ENV_ENV" = "dclm-dev" ]; then
    env="dev"
  else
    echo "DL_ENV_ENV value not what is expected!"
    exit 0
  fi

  # Read the .env file and set the secrets
  # while IFS='=' read -r key value
  # do
  #   # Skip lines starting with '#' (comments)
  #   if [ -n "$key" ] && [[ $key != \#* ]]; then
  #     # Trim leading/trailing whitespaces
  #     key=$(echo "$key" | xargs)
  #     value=$(echo "$value" | xargs)

  #     # Set the secret
  #     gh secret set "$key" -b"$value" -e"$env"
  #   fi
  # done < $envfile
  gh secret set -f "$envfile" -e"$env"

  # Check return code and output result
  if [ $? -eq 0 ]; then
    echo -e "Secrets set successfully\n"
  else
    echo -e "Error setting secrets\n"
    exit 1
  fi
}

gh_secret_public_rm() {
  # Check the DL_ENV_ENV variable
  if [ "$DL_ENV_ENV" = "dclm-prod" ]; then
    env="prod"
  elif [ "$DL_ENV_ENV" = "dclm-dev" ]; then
    env="dev"
  else
    echo "Haa! No need then..."
    exit 0
  fi

  # Read the envfile line by line and delete the secrets
  while IFS= read -r line; do

    # Skip lines starting with '#' (comments)
    if [ -n "$line" ] && [[ $line != \#* ]]; then
      # Trim leading/trailing whitespaces
      line=$(echo "$line" | xargs)
      gh secret delete "$line" --repo $DL_REPO --env"$env"
    fi
  done < "$envfile"

  # Check return code and output result
  if [ $? -eq 0 ]; then
    echo -e "Secrets deleted successfully\n"
  else
    echo -e "Error deleting secrets\n"
    exit 1
  fi
}

gh_variable_private() {
  vhost=${DL_VHOST_CONFIG}
  gh variable set NGX < "$vhost"
  rm -f "$file"

  # Check return code and output result
  if [ $? -eq 0 ]; then
    echo -e "Variables set successfully\n"
  else
    echo -e "Error setting variables\n"
    exit 1
  fi
}

gh_variable_private_rm() {
  vhost=${DL_VHOST_CONFIG}
  gh variable delete NGX < "$vhost"
  rm -f "$file"

  # Check return code and output result
  if [ $? -eq 0 ]; then
    echo -e "Variables deleted successfully\n"
  else
    echo -e "Error deleting variables\n"
    exit 1
  fi
}

gh_variable_public() {
  # Check the DL_ENV_ENV variable
  if [ "$DL_ENV_ENV" = "dclm-prod" ]; then
    env="prod"
  elif [ "$DL_ENV_ENV" = "dclm-dev" ]; then
    env="dev"
  else
    echo "Haa! No need then..."
    exit 0
  fi

  vhost=${DL_VHOST_CONFIG}
  gh variable set NGX < "$vhost" -e"$env"
  rm -f "$file"

  # Check return code and output result
  if [ $? -eq 0 ]; then
    echo -e "Variables set successfully\n"
  else
    echo -e "Error setting variables\n"
    exit 1
  fi
}

gh_variable_public_rm() {
  # Check the DL_ENV_ENV variable
  if [ "$DL_ENV_ENV" = "dclm-prod" ]; then
    env="prod"
  elif [ "$DL_ENV_ENV" = "dclm-dev" ]; then
    env="dev"
  else
    echo "Haa! No need then..."
    exit 0
  fi

  vhost=${DL_VHOST_CONFIG}
  gh variable delete NGX < "$vhost" -e"$env"
  rm -f "$file"

  # Check return code and output result
  if [ $? -eq 0 ]; then
    echo -e "Variables deleted successfully\n"
  else
    echo -e "Error deleting variables\n"
    exit 1
  fi
}



# Check if a choice was provided as a command line argument
if [ $# -eq 0 ]; then
  # If no choice was provided, prompt for action
  echo -e "\nSelect action:"
  echo "1) Set secret on private repo"
  echo "2) Delete secret on private repo"
  echo "3) Set secret on public repo"
  echo "4) Delete secret on public repo" 
  echo "5) Set variable on private repo"
  echo "6) Delete variable on private repo"
  echo "7) Set variable on public repo"
  echo "8) Delete variable on public repo"
  echo "9) Another job"
  read -p $'\nEnter choice [1-9]: ' choice
else
  # If an argument is provided, use it
  choice="$1"
  envfile="$2"
fi

# Check that an env file argument was provided
if [ $# -ne 2 ]; then
  echo "Usage: $0 <choice> <envfile>"
  exit 1
fi

# Validate that the env file exists
  if [ ! -f "$envfile" ]; then
    echo "Error: Env file '$envfile' not found"
    exit 1
  fi

# Source the .env file
source $envfile

if [ $choice -eq 1 ]; then
  gh_secret_private
elif [ $choice -eq 2 ]; then
  gh_secret_private_rm
elif [ $choice -eq 3 ]; then
  gh_secret_public
elif [ $choice -eq 4 ]; then
  gh_secret_public_rm
elif [ $choice -eq 5 ]; then
  gh_variable_private
elif [ $choice -eq 6 ]; then
  gh_variable_private_rm
elif [ $choice -eq 7 ]; then
  gh_variable_public
elif [ $choice -eq 8 ]; then
  gh_variable_public_rm
elif [ $choice -eq 9 ]; then
  userJob
else
  echo "Invalid selection"
  exit 1  
fi
