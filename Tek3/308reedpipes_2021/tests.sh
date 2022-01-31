#!/bin/bash

OK="\x1b[32;01m[✔]\x1b[0m"
KO="\x1b[31;01m[X]\x1b[0m"

BOLD="\033[1m"
UNBOLD="\033[0m"

if [ -z "$1" ]; then
    echo "Usage: $0 <binary>"
    exit 1
fi
binary="./$1"

tmp_file=$(mktemp)

count_test_passed=0
count_test_failed=0

function test_binary() {
    $binary $1 >$tmp_file
    exit_value=$?
    if [ $exit_value = 0 ]; then
        res=$(diff $tmp_file "$2")
        if [ $? == 0 ]; then
            echo -en "$OK "
            echo "$1"
            count_test_passed=$((count_test_passed + 1))
        else
            echo -en "$KO "
            echo "$1"
            echo $res
            count_test_failed=$((count_test_failed + 1))
        fi
    else
        echo -en "$KO "
        echo "$1"
        echo -e "\texit with '$exit_value'"
        echo -e "\texpected '0'"
        count_test_failed=$((count_test_failed + 1))
    fi
}

OIFS="$IFS"
IFS=$'\n'
for file in $(find examples -type f ! -name .gitignore); do
    IFS="$OIFS"
    test_binary "$(basename "$file")" "$file"
    OIFS="$IFS"
    IFS=$'\n'
done

echo
echo -e "$BOLD""$count_test_passed tests passed""$UNBOLD"
echo -e "$BOLD""$count_test_failed tests failed""$UNBOLD"
