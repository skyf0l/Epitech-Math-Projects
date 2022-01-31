#!/bin/bash

function test_pacman() {
    ./304pacman "$1" "$2" "$3" > "$1.out"
    diff "$1.out" "$1.ans"
    if [ $? -eq 0 ]; then
        echo "Test $1 passed"
    else
        echo "Test $1 failed"
    fi
}

test_pacman "examples/map1" "+" " "
test_pacman "examples/map2" "@" " "