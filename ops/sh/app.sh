#!/bin/bash

# add envfile to shell
source ./src/.env

# function to check which git branch
git_branch() {
  # Get the current Git branch
  branch=$(git rev-parse --abbrev-ref HEAD)

  # Check if branch is dclm-dev or dclm-prod
  if [[ $branch != "dclm-dev" ]] && [[ $branch != "dclm-prod" ]]; then

    # Prompt the user to select a branch  
    echo "Current branch is $branch"
    echo "Please select branch:"
    echo "1) dclm-dev" 
    echo "2) dclm-prod"
    read -p "Enter choice: " choice

    # Switch based on choice
    case $choice in
      1) 
        echo "Switching to main branch"
        git switch dclm-dev
        ;;
      2)
        echo "Switching to dclm-dev branch" 
        git switch dclm-prod
        ;;
      *)
        echo "Invalid choice" >&2
        exit 1
        ;;
    esac

  else 
    echo -e "Git Repo: You're on \033[32m$branch\033[0m branch"
  fi
}

#---------------------------------------#
# init                                  #
#---------------------------------------#
# function to create a git repo locally
git_repo_create() {
	read -p $'\nDo you want to create a git repo? (yes|no): ' repo_init
	case "$repo_init" in
		yes|Y|y)
			if [ -d .git ]; then
				echo -e "\033[31mCurrent directory already initialised \033[0m\n"
			else
				echo -e "\033[32mPlease enter initial commit message: \033[0m\n"
				read -r commitMsg
				git init && git add . && git commit -m "$commitMsg"
			fi
			;;
		no|N|n)
			echo -e "\033[32mNothing to be done. Thank you...\033[0m"
			;;
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m"
			;;
	esac
}

# function to create a repository on GitHub
gh_repo_create() {
	read -p $'\nDo you want to create a github repo? (yes|no): ' repo_name
	case "$repo_name" in
		yes|Y|y)
			read -p "Enter GitHub username: " ghUser
			read -p "Enter GitHub repo name: " ghName
      gh="$ghUser/$ghName"
			result="$(gh_repo_check arg1 $gh)"
			if [ $result -eq 200 ]; then
				echo -e "\033[31mGitHub repo exists. I stop here. \033[0m\n"
			else
				echo -e "\nWhich type of repository are you creating?:"
				echo "1. Private repo"
				echo "2. Public repo"
				read -p "Enter a number to select your choice: " repoType
				if [ $repoType -eq 1 ]; then
					REPO=private
				elif [ $repoType -eq 2 ]; then
					REPO=public
				else
					echo "Invalid choice"
					exit 0
				fi
				gh repo create ${ghUser}/${ghName} --$REPO --source=. --remote=origin
			fi
			;;
		no|N|n)
			echo -e "\033[32mOkay, thank you...\033[0m"
			;;
		*)
			echo -e "\033[32m No choice. Exiting script...\033[0m"
			;;
	esac
}

#---------------------------------------#
# app                                   #
#---------------------------------------#
# function to commit git repository
git_commit() {
  # function to commit repo with untracked files
  git_commit_new() {
    read -p $'\nDo you want to commit repo? (yes|no): ' git_commit
    case "$git_commit" in
      yes|Y|y)
        echo -e "\033[31mUntracked files found::\033[0m \033[32mPlease enter commit message:\033[0m"
        read -r msg1
        git add -A
        git commit -m "$msg1"
        ;;
      no|N|n)
        echo -e "\033[32mNothing to be done. Thank you...\033[0m"
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m"
        ;;
    esac
  }

  # function to commit repo with modified files
  git_commit_old() {
    read -p $'\nDo you want to commit repo? (yes|no): ' git_commit
    case "$git_commit" in
      yes|Y|y)
        echo -e "\033[31mModified files found...\033[0m \033[32mPlease enter commit message:\033[0m"
        read -r msg2
        git commit -am "$msg2"
        ;;
      no|N|n)
        echo -e "\033[32mNothing to be done. Thank you...\033[0m"
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m"
        ;;
    esac
  }

  if git status --porcelain | grep -q "^??"; then
    git_commit_new
  elif git status --porcelain | grep -qE '[^ADMR]'; then
    git_commit_old
  elif [ -z "$(git status --porcelain)" ]; then
    echo -e "\033[31m Nothing to commit, thanks...\033[0m\n"
  else
    echo -e "\033[31m Unknown status. Aborting...\033[0m\n"
    exit 1
  fi
}

docker_build() {
  # function to purge docker images
  dkr_purge_image() {
    read -p $'\nDo you want to purge image? (yes|no): ' dkr_purge
    case "$dkr_purge" in
      yes|Y|y)
        if [ "$(docker images -qf "dangling=true")" ]; then
          echo -e "\033[31mRemoving dangling images...\033[0m"
          docker image prune -f
        fi
        ;;
      no|N|n)
        echo -e "\033[32mNothing to be done. Thank you...\033[0m"
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m"
        ;;
    esac
  }

  # function to delete docker image
  dkr_rmi_image() {
    read -p $'\nDo you want to remove image? (yes|no): ' dkr_rmi
    case "$dkr_rmi" in
      yes|Y|y)
        if docker image inspect $DL_DIN &> /dev/null; then \
          echo -e "\033[31mDeleting existing image...\033[0m"; \
          docker rmi $DL_DIN; \
        fi
        ;;
      no|N|n)
        echo -e "\033[32mNothing to be done. Thank you...\033[0m"
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m"
        ;;
    esac
  }

  # function to build docker image
  dkr_build_image() {
    read -p $'\nDo you want to build image? (yes|no): ' dkr_build
    case "$dkr_build" in
      yes|Y|y)
        echo -e "\033[32mBuilding $DL_DIN image\033[0m"
        docker build -t $DL_DIN -f $DL_DFILE .
        docker images | grep $DL_IU/$DL_IN
        ;;
      no|N|n)
        echo -e "\033[32mNothing to be done. Thank you...\033[0m"
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m"
        ;;
    esac
  }

  dkr_purge_image
  dkr_rmi_image
  dkr_build_image
}

#---------------------------------------#
# deploy                                #
#---------------------------------------#
git_push() {
  git_branch
  ga_workflow_env argv $DL_ENV
  gh_secret_set argv $DL_ENV
  git_repo_push
}

ga_workflow_env() {
  read -p $'\nDo you want to create workflow env? (yes|no): ' ga_workflow
  case "$ga_workflow" in
    yes|Y|y)
      # check if argument is provided
      if [ $# -ne 2 ]; then
        read -p $'\nEnvfile not found... Enter path to env file: ' env
        envfile="$env"
      else
        envfile="$2"
      fi

      vfile="./ops/vars.txt"
      ga_file1="deploy.yml"
      ga_file2="deploy_new.yml"
      ga_dir="./.github/workflows"
      ga="$ga_dir/$ga_file1"
      ga_new="$ga_dir/$ga_file2"

      # Delete vars.txt if it exists
      if [ -f $vfile ]; then
        rm $vfile
      fi

      # Read .env file
      IFS=' ' read -r -a exclude <<< "$DL_EXCLUDE"
      while IFS= read -r kv; do
        key=$(echo "$kv" | cut -d= -f1)

        if [[ " ${exclude[@]} " =~ " $key " ]]; then
          continue
        fi

        if [[ $key != "" && $key != "#"* ]]; then
          echo "$key" >> $vfile
        fi
      done < <(grep '=' $envfile)

      # Load variables from vars.txt
      while read -r var; do
        vars+=($var)
      done < $vfile

      # Find the Generate envfile step in deploy.yml
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
      rm -f $vfile
      echo -e "Actions worklow updated successfully!\n"
      ;;
    no|N|n)
      echo -e "\033[32mNothing to be done. Thank you...\033[0m"
      ;;
    *)
      echo -e "\033[32mNo choice. Exiting script...\033[0m"
      ;;
  esac
}

gh_secret_set() {
  # function to set secrets on private GitHub repo
  gh_secret_private() {
    read -p "Do you want to set secrets on private repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "\033[32mSetting secrets...\033[0m\n"
        # check if argument is provided
        if [ $# -ne 2 ]; then
          read -p $'\nEnvfile not found... Enter path to env file: ' env
          envfile="$env"
        else
          envfile="$2"
        fi

        # Run gh secret set, reading from the env file 
        gh secret set -f "$envfile"

        # Check return code and output result
        if [ $? -eq 0 ]; then
          echo -e "Secrets set successfully\n"
        else
          echo -e "Error setting secrets\n"
          exit 1
        fi
        ;;
      no|N|n)
        echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m\n"
        exit 1
        ;;
    esac
  }

  # function to delete secrets on private GitHub repo
  gh_secret_private_rm() {
    read -p "Do you want to delete secrets on private repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "\033[32mDeleting secrets...\033[0m\n"
        # check if argument is provided
        if [ $# -ne 2 ]; then
          read -p $'\nEnvfile not found... Enter path to env file: ' env
          envfile="$env"
        else
          envfile="$2"
        fi

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
        ;;
      no|N|n)
        echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m\n"
        exit 1
        ;;
    esac
  }

  # function to set secrets on public GitHub repo
  gh_secret_public() {
    read -p "Do you want to set secrets on public repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "\033[32mSetting secrets...\033[0m\n"
        # check if argument is provided
        if [ $# -ne 2 ]; then
          read -p $'\nEnvfile not found... Enter path to env file: ' env
          envfile="$env"
        else
          envfile="$2"
        fi

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
        gh secret set -f "$envfile" -e"$env"

        # Check return code and output result
        if [ $? -eq 0 ]; then
          echo -e "Secrets set successfully\n"
        else
          echo -e "Error setting secrets\n"
          exit 1
        fi
        ;;
      no|N|n)
        echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m\n"
        exit 1
        ;;
    esac
  }

  # function to delete secrets on public GitHub repo
  gh_secret_public_rm() {
    read -p "Do you want to delete secrets on public repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "\033[32mDeleting secrets...\033[0m\n"
        # check if argument is provided
        if [ $# -ne 2 ]; then
          read -p $'\nEnvfile not found... Enter path to env file: ' env
          envfile="$env"
        else
          envfile="$2"
        fi

        # Check the DL_ENV_ENV variable
        if [ "$DL_ENV_ENV" = "dclm-prod" ]; then
          env="prod"
        elif [ "$DL_ENV_ENV" = "dclm-dev" ]; then
          env="dev"
        else
          echo "Aha! No need then..."
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
        ;;
      no|N|n)
        echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m\n"
        exit 1
        ;;
    esac
  }

  # function to set variables on private GitHub repo
  gh_variable_private() {
    read -p "Do you want to set variables on private repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "\033[32mSetting variables...\033[0m\n"
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
        ;;
      no|N|n)
        echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m\n"
        exit 1
        ;;
    esac
  }

  # function to delete variables on private GitHub repo
  gh_variable_private_rm() {
    read -p "Do you want to delete variables on private repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "\033[32mDeleting variables...\033[0m\n"
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
        ;;
      no|N|n)
        echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m\n"
        exit 1
        ;;
    esac
  }

  # function to set variables on public GitHub repo
  gh_variable_public() {
    read -p "Do you want to set variables on public repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "\033[32mSetting variables...\033[0m\n"
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
        ;;
      no|N|n)
        echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m\n"
        exit 1
        ;;
    esac
  }

  # function to delete variables on public GitHub repo
  gh_variable_public_rm() {
    read -p "Do you want to delete variables on public repo? (yes|no): " git_push
    case "$git_push" in
      yes|Y|y)
        echo -e "\033[32mDeleting variables...\033[0m\n"
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
        ;;
      no|N|n)
        echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m\n"
        exit 1
        ;;
    esac
  }

  check="$(gh_repo_view)"
  if [ "$check" == "private" ]; then
    gh_secret_private
    gh_variable_private
    gh_secret_private_rm
    gh_variable_private_rm
  elif [ "$check" == "public" ]; then
    gh_secret_public
    gh_variable_public
    gh_secret_public_rm
    gh_variable_public_rm
  else
    echo "Could not set secrets. Something is wrong!" >&2
    exit 1
  fi
}

git_repo_push() {
  read -p "Do you want to push your commit to GitHub? (yes|no): " git_push
  case "$git_push" in
    yes|Y|y)
      echo -e "\033[32mPushing commit to GitHub...\033[0m\n"
      git push
      ;;
    no|N|n)
      echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"
      ;;
    *)
      echo -e "\033[32mNo choice. Exiting script...\033[0m\n"
      exit 1
      ;;
  esac
}

# function to push docker image
docker_push() {
  # which git branch?
  git_branch

	read -p $'\nDo you want to push docker image? (yes|no): ' dkr_push
	case "$dkr_push" in
		yes|Y|y)
			echo ${DL_DLP} | docker login -u ${DL_DLU} --password-stdin
	    docker push $DL_DIN
			;;
		no|N|n)
			echo -e "\033[32mNothing to be done. Thank you...\033[0m"
			;;
		*)
			echo -e "\033[32mNo choice. Exiting script...\033[0m"
			;;
	esac
}

#---------------------------------------#
# github actions                        #
#---------------------------------------#
# function to create dns record on aws route53
create_dns_record() {
  # Run the AWS CLI command to list resource record sets
  record_sets=$(aws route53 list-resource-record-sets \
    --hosted-zone-id "$HOSTED_ZONE_ID" \
    --query "ResourceRecordSets[?Name == '$APP_URL.']" \
    --output json)

  # Check if the record_sets variable is empty (DNS entry doesn't exist)
  if echo "$record_sets" | jq -e '.[].Name | test("'$URL1'\\.'$URL2'\\.'$URL3'")' > /dev/null; then
    echo "DNS entry $APP_URL exists."
    exit 0
  else
    echo "Creating DNS entry for $APP_URL..."
    touch route53.json
  cat >route53.json <<EOF
  {
    "Comment": "CREATE record ",
    "Changes": [{
    "Action": "CREATE",
      "ResourceRecordSet": {
        "Name": "$APP_URL",
        "Type": "A",
        "TTL": 300,
        "ResourceRecords": [{ "Value": "$SERVER_IP"}]
    }}]
  }
EOF
    cat route53.json
    aws route53 change-resource-record-sets --hosted-zone-id "$HOSTED_ZONE_ID" --change-batch file://route53.json
  fi
}

# function to create directory to deploy app  
create_app_dir() {
  # Set the target directory 
  docker_dir="$CODE_HIVE"
  app_dir="$IN"

  # Navigate into the docker directory
  cd "$docker_dir"

  # Check if target folder exists
  if [ ! -d "$app_dir" ]; then
    # Folder doesn't exist, create it
    echo "Creating folder $app_dir"  
    mkdir -p "$app_dir"

  else
    # Folder exists, print message
    echo "Folder $app_dir already exists"

  fi
}

# function to clone app repository 
clone_app_repo() {
  # Check app dir
  echo -e "\nChecking if app directory exists.."
  if [ ! -d "$APP_DIR" ]; then
    echo "Directory not found, creating..."
    mkdir -p "$APP_DIR"
  else
    echo "Directory already exists."
  fi

  # Enter into app dir
  echo -e "\nEntering app directory.."
  cd "$APP_DIR"

  # Clone app repo
  echo -e "\nCloning latest repo changes.."
  if [ ! -d .git ]; then
    echo "App repo not found. Cloning..."
    git clone "$REPO" . \
    && git switch "$GIT_BRANCH"
  else
    echo "App repo exists..."
    git fetch --all \
    && git switch "$GIT_BRANCH"
  fi
}

# function to create nginx vhost for app url
create_nginx_vhost() {
  # enter directory
  cd "$ENV_DEST"

  # another way
  ngxx="vhost.conf"
  ngx=$(cat "$ngxx")
  # echo -e "Content of ngx:"
  # echo "$VHOST"

  eval "VHOST=\"$ngx\""
  # eval "VHOST=\"$VHOST_CONFIG\""

  # Create a temporary file with the provided configuration
  echo -e "\nCreating temporary file..."
  temp_file="$(mktemp)"
  echo "$VHOST" > "$temp_file"
  # echo -e "Content of temporal file:"
  # cat "$temp_file"

  # Extract the block identifier (the first line of the provided config)
  echo -e "\nExtracting the vhost block identifier..."
  block_identifier=$(head -n 1 "$temp_file")
  echo -e "Content of block identifier:\n$block_identifier"

  # Check if the vhost configuration exists
  echo -e "\nChecking if vhost config exists..."
  if grep -qF "$block_identifier" "$NGINX_CONF_DIR/$NGINX_CONF_FILE"; then
    echo -e "Vhost config already exists."

    # Get the existing vhost block that matches the block identifier
    echo -e "\nExtracting existing vhost config..."
    end_pattern="^}"
    existing_block="$(sed -n "/$block_identifier/,/$end_pattern/p" "$NGINX_CONF_DIR/$NGINX_CONF_FILE")"
    echo -e "Content of existing vhost:\n$existing_block"

    # Compare the existing block with the provided configuration
    echo -e "\nComparing existing vhost config with provided vhost config..."
    if diff -q <(echo "$VHOST") <(echo "$existing_block"); then
      echo "Configuration matches. No action needed."
    else
      # Delete the existing vhost configuration and append the provided config
      echo -e "\nDeleting existing vhost config..."
      sed -i "/$block_identifier/,/$end_pattern/d" "$NGINX_CONF_DIR/$NGINX_CONF_FILE"

      echo -e "\nUpdating vhost config..."
      echo -e "\n$VHOST" | sudo tee -a "$NGINX_CONF_DIR/$NGINX_CONF_FILE"
      # echo "$VHOST" | tr "\r" "\n" >> "$NGINX_CONF_DIR/$NGINX_CONF_FILE"
      # echo -e "$VHOST\r" >> "$NGINX_CONF_DIR/$NGINX_CONF_FILE"
      echo "Nginx vhost configuration updated."

      # Test Nginx configuration for syntax errors
      sudo nginx -t

      # Reload Nginx if the configuration is valid
      if [ $? -eq 0 ]; then
        sudo nginx -s reload
        sudo systemctl status nginx
      else
        echo "Nginx configuration is invalid. Not reloading Nginx."
      fi 
    fi
  else
    echo "Nginx vhost configuration not found."
    echo "Creating Nginx vhost entry for $APP_URL..."
    echo -e "\n$VHOST" | sudo tee -a "$NGINX_CONF_DIR/$NGINX_CONF_FILE"

    # Test Nginx configuration for syntax errors
    sudo nginx -t

    # Reload Nginx if the configuration is valid
    if [ $? -eq 0 ]; then
      sudo nginx -s reload
      sudo systemctl status nginx
    else
      echo "Nginx configuration is invalid. Not reloading Nginx."
    fi  
  fi

  # Remove temporary files
  echo -e "\nRemoving temporary files..."
  rm -f "$temp_file"
  rm -f "$ngxx"
}

# function to deploy app
ga_deploy_app() {
  # Enter app dir
  echo -e "\nEntering app directory..."
  cd "$APP_DIR"

  # Pull repo changes
  echo -e "\nDownloading latest repo changes..."
  make new

  # Drop running container
  echo -e "\nDropping running container..."
  make down

  # Start new container
  echo -e "\nLaunching latest app version..."
  make run
}

#---------------------------------------#
# utils                                 #
#---------------------------------------#
# function to copy .env based on environment
copy_app_env() {
  # Define the source and destination directories
  src_dir="./ops"
  dest_dir="./src"

  # Define environment file
  dest_env=".env"
  default_env_file="bams-dev.env"

  # Display the options
  echo "Please select an environment:"
  echo "1) dclm-dev"
  echo "2) dclm-prod"
  echo "3) Custom env"

  # Read the user's selection
  read -p "Select an option or press enter to copy default: " selection

  # Handle the user's selection
  case $selection in
    1)
      env_file="dclm-dev.env"
      ;;
    2)
      env_file="dclm-prod.env"
      ;;
    3)
      read -p "Enter the name of the custom environment file: " env_file
      ;;
    "")
      env_file=$default_env_file
      ;;
    *)
      echo -e "Invalid option. Please select 1, 2, or 3\n"
      ;;
  esac

  # Copy the environment file
  cp "${src_dir}/${env_file}" "${dest_dir}/${dest_env}"

  # Check if the copy was successful
  if [ $? -eq 0 ]; then
    echo -e "Environment file copied successfully.\n"
  else
    echo -e "Failed to copy environment file. Exiting.\n"
    exit 1
  fi
}

# function to scan GitHub repo
git_repo_scan() {
	read -p "Do you want to scan this repo? (yes|no): " repo_scan
	case "$$repo_scan" in
		yes|Y|y)
			echo -e "\033[32mScanning repo for secrets...\033[0m\n"
			ggshield secret scan repo .
			;;
		no|N|n)
			echo -e "\033[32mOkay. Thank you...\033[0m\n"
			exit 0
			;;
		*)
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"
			exit 1
			;;
	esac  
}

#function to rename local git repo
git_repo_rename() {
  echo -e "I love JESUS"
}

# function to rename GitHub repo
gh_repo_rename() {
  read -p "Enter GitHub username: " GH_USER

  repo_name() {
    read -p "Enter current repository name: " GH_REPO
    read -p "Enter new repository name: " NEW_NAME
    # API to rename repo
    API_ENDPOINT="https://api.github.com/repos/${GH_USER}/${GH_REPO}"

    # Make API call to rename repo
    curl \
      -X PATCH \
      -H "Authorization: token ${DL_GH_TOKEN}" \
      -d '{"name":"'"${NEW_NAME}"'"}' \
      ${API_ENDPOINT}

    if [ $? -eq 0 ]; then
      echo -e "Repository renamed successfully!\n"
    else
      echo -e "Error renaming repository\n" >&2
      exit 1
    fi

    # run function to change repo remote url
    repo_url
  }

  repo_url() {
    read -p "About to change repo's remote url. Proceed? (yes|no): " user_grant
    case "$user_grant" in
      yes|Y|y)
        read -p "Enter new repository name: " NEW_NAME
        git remote set-url origin git@github.com:${GH_USER}/${NEW_NAME}.git
        git remote -v
        if [ $? -eq 0 ]; then
          echo "Remote url successfully set!"
        else
          echo "Error renaming repository" >&2
          exit 1
        fi
        ;; 
      no|N|n) 
        echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"
        exit 0
        ;;
      *)
        echo -e "\033[32mNo choice. Exiting script...\033[0m\n"
        exit 1
        ;;
    esac
  }
  # Select action
  echo "Select action:"
  echo "1) Rename repo name on Github"
  echo "2) Rename repo remote url"
  read action_selection
  if [ $action_selection -eq 1 ]; then
    repo_name
  elif [ $action_selection -eq 2 ]; then
    repo_url
  else
    echo "Invalid selection"
    exit 1  
  fi
}

# function to check if GitHub repo exists
gh_repo_check() {
  # check if argument is provided
  if [ $# -ne 2 ]; then
    read -p "Enter GitHub username: " ghUser
		read -p "Enter GitHub repo name: " ghName
    repo="${ghUser}/${ghName}"
  else
    repo=$2
  fi

  status_code=$(curl -s -o /dev/null -w "%{http_code}" -H "Authorization: token ${DL_GH_TOKEN}" "https://api.github.com/repos/$repo")

  code1=200
  code2=404

  if [ $status_code -eq 200 ]; then
    echo $code1
  elif [ $status_code -eq 404 ]; then
    echo $code2
  else
    echo "Status code: $status_code" >&2
    exit 1
  fi
}

# function to check if GitHub repo is private/public
gh_repo_view() {
  view=$(gh repo view $DL_REPO --json isPrivate -q .isPrivate 2>/dev/null)
	if [ "$view" = "true" ]; then
		repo_view=private
	else
		repo_view=public
	fi
}




# Check if a choice was provided as a command line argument
if [ $# -eq 0 ]; then
  # If no choice was provided, prompt for action
  echo "1) Create local repo"
  echo "2) Create GitHub repo"
  echo "3) Commit git repo"
  echo "4) Build docker image" 
  echo "5) Push docker image"
  echo "6) Push git repo"
  echo "7) Create DNS record"
  echo "8) Create app directory"
  echo "9) Clone app repo"
  echo "10) Create Nginx vhost"
  echo "11) Deploy app to server"
  echo "----------------------------------"
  read -p $'\nSelect action to perform [1-9]: ' choice
else
  # If an argument is provided, use it
  choice="$1"
fi

if [ $choice -eq 1 ]; then
  git_repo_create
elif [ $choice -eq 2 ]; then
  gh_repo_create
elif [ $choice -eq 3 ]; then
  git_commit
elif [ $choice -eq 4 ]; then
  docker_build
elif [ $choice -eq 5 ]; then
  git_push
elif [ $choice -eq 6 ]; then
  docker_push
elif [ $choice -eq 7 ]; then
  create_dns_record
elif [ $choice -eq 8 ]; then
  create_app_dir
elif [ $choice -eq 9 ]; then
  clone_app_repo
elif [ $choice -eq 10 ]; then
  create_nginx_vhost
elif [ $choice -eq 11 ]; then
  ga_deploy_app
elif [ $choice -eq 12 ]; then
  copy_app_env
elif [ $choice -eq 13 ]; then
  git_repo_scan
elif [ $choice -eq 14 ]; then
  git_repo_rename
elif [ $choice -eq 15 ]; then
  gh_repo_rename
elif [ $choice -eq 16 ]; then
  gh_repo_check
elif [ $choice -eq 17 ]; then
  gh_repo_view
else
  echo "Invalid selection"
  exit 1  
fi
