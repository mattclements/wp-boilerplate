#!/bin/bash
export LC_CTYPE=C 
export LANG=C

if [ -z "$1" ]
then
    echo "Please provide the new Theme Name"
    exit 1
fi

export THEME_NAME="$1"

mv ./wp-content/themes/boilerplate "./wp-content/themes/$THEME_NAME"

find "./wp-content/themes/$THEME_NAME" -type f -exec sed -i'' -e "s/boilerplate/$THEME_NAME/g" {} \;