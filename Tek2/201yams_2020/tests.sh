#!/bin/bash

function tests_error() {
    res=$($1)
    if [[ $? == 84 ]]; then
        echo -e "\x1b[32;01m[✔]\x1b[0m $1"
    else
        echo -e "\x1b[31;01m[X]\x1b[0m $1"
        echo -e "got      $res"
        echo -e "expected return 84"
    fi
}

function tests() {
    res=$($1)
    if [[ $res == *"$2"* ]]; then
        echo -e "\x1b[32;01m[✔]\x1b[0m $1"
    else
        echo -e "\x1b[31;01m[X]\x1b[0m $1"
        echo -e "got      $res"
        echo -e "expected $2"
    fi
}

echo -e "\033[1mTest rigor :\033[0m"
tests_error "./201yams"
tests_error "./201yams 1"
tests_error "./201yams 1 1"
tests_error "./201yams 1 1 1"
tests_error "./201yams 1 1 1 1"
tests_error "./201yams 1 1 1 1 1"
tests_error "./201yams 1 1 1 1 1 pair_1 1"
tests_error "./201yams 1 1 1 1 1 pair"
tests_error "./201yams 1 1 1 1 1 pair_1_1"
tests_error "./201yams 1 1 1 1 1 gay_1"
tests_error "./201yams 1 1 1 7 1 pair_1"
tests_error "./201yams 1 1 1 1 1 pair_0"
tests_error "./201yams 1 1 1 1 1 pair_7"
tests_error "./201yams 1 -1 1 1 1 pair_7"
tests_error "./201yams 1 1 2 3 4 pair_1_1"
tests_error "./201yams 1 1 1 2 3 three_1_1"
tests_error "./201yams 1 1 1 1 2 four_1_1"
tests_error "./201yams 1 1 1 2 2 full_1_2_1"
tests_error "./201yams 1 1 1 1 1 yams_1_1"
tests_error "./201yams 1 2 3 4 5 straight_5_1"
tests_error "./201yams 2 3 4 5 6 straight_6_1"
tests_error "./201yams 1 1 1 2 2 full_1"
tests_error "./201yams 1 1 1 2 2 full1"
tests_error "./201yams 1 2 3 4 5 straight_4"

echo
echo -e "\033[1mTest usage :\033[0m"

tests "./201yams 1 1 2 3 4 pair_1"      "Chances to get a 1 pair: 100.00%"
tests "./201yams 1 1 1 2 3 three_1"     "Chances to get a 1 three-of-a-kind: 100.00%"
tests "./201yams 1 1 1 1 2 four_1"      "Chances to get a 1 four-of-a-kind: 100.00%"
tests "./201yams 1 1 1 2 2 full_1_2"    "Chances to get a 1 full of 2: 100.00%"
tests "./201yams 1 1 1 1 1 yams_1"      "Chances to get a 1 yams: 100.00%"
tests "./201yams 1 2 3 4 5 straight_5"  "Chances to get a 5 straight: 100.00%"
tests "./201yams 2 3 4 5 6 straight_6"  "Chances to get a 6 straight: 100.00%"

# subject
tests "./201yams 0 0 0 0 0 yams_4"      "Chances to get a 4 yams: 0.01%"
tests "./201yams 1 2 3 4 5 four_4"      "Chances to get a 4 four-of-a-kind: 1.62%"
tests "./201yams 2 2 5 4 6 straight_6"  "Chances to get a 6 straight: 16.67%"
tests "./201yams 0 0 0 0 0 full_2_3"    "Chances to get a 2 full of 3: 0.13%"
tests "./201yams 2 3 2 3 2 full_2_3"    "Chances to get a 2 full of 3: 100.00%"

# pair
tests "./201yams 1 1 4 4 4 pair_1"      "Chances to get a 1 pair: 100.00%"
tests "./201yams 1 1 1 4 4 pair_1"      "Chances to get a 1 pair: 100.00%"
tests "./201yams 1 1 1 1 4 pair_1"      "Chances to get a 1 pair: 100.00%"
tests "./201yams 1 1 1 1 1 pair_1"      "Chances to get a 1 pair: 100.00%"
tests "./201yams 1 4 4 4 4 pair_1"      "Chances to get a 1 pair: 51.77%"
tests "./201yams 4 4 4 4 4 pair_1"      "Chances to get a 1 pair: 19.62%"

# three
tests "./201yams 1 1 1 4 4 three_1"      "Chances to get a 1 three-of-a-kind: 100.00%"
tests "./201yams 1 1 1 1 4 three_1"      "Chances to get a 1 three-of-a-kind: 100.00%"
tests "./201yams 1 1 1 1 1 three_1"      "Chances to get a 1 three-of-a-kind: 100.00%"
tests "./201yams 1 1 4 4 4 three_1"      "Chances to get a 1 three-of-a-kind: 42.13%"
tests "./201yams 1 4 4 4 4 three_1"      "Chances to get a 1 three-of-a-kind: 13.19%"
tests "./201yams 4 4 4 4 4 three_1"      "Chances to get a 1 three-of-a-kind: 3.55%"

# four
tests "./201yams 1 1 1 1 4 four_1"      "Chances to get a 1 four-of-a-kind: 100.00%"
tests "./201yams 1 1 1 1 1 four_1"      "Chances to get a 1 four-of-a-kind: 100.00%"
tests "./201yams 1 1 1 4 4 four_1"      "Chances to get a 1 four-of-a-kind: 30.56%"
tests "./201yams 1 1 4 4 4 four_1"      "Chances to get a 1 four-of-a-kind: 7.41%"
tests "./201yams 1 4 4 4 4 four_1"      "Chances to get a 1 four-of-a-kind: 1.62%"
tests "./201yams 4 4 4 4 4 four_1"      "Chances to get a 1 four-of-a-kind: 0.33%"

# yams
tests "./201yams 1 1 1 1 1 yams_1"      "Chances to get a 1 yams: 100.00%"
tests "./201yams 1 1 1 1 4 yams_1"      "Chances to get a 1 yams: 16.67%"
tests "./201yams 1 1 1 4 4 yams_1"      "Chances to get a 1 yams: 2.78%"
tests "./201yams 1 1 4 4 4 yams_1"      "Chances to get a 1 yams: 0.46%"
tests "./201yams 1 4 4 4 4 yams_1"      "Chances to get a 1 yams: 0.08%"
tests "./201yams 4 4 4 4 4 yams_1"      "Chances to get a 1 yams: 0.01%"

# straight
tests "./201yams 1 2 3 4 5 straight_5"      "Chances to get a 5 straight: 100.00%"
tests "./201yams 1 2 3 4 4 straight_5"      "Chances to get a 5 straight: 16.67%"
tests "./201yams 1 2 3 3 3 straight_5"      "Chances to get a 5 straight: 2.78%"
tests "./201yams 1 2 2 2 2 straight_5"      "Chances to get a 5 straight: 0.46%"
tests "./201yams 1 1 1 1 1 straight_5"      "Chances to get a 5 straight: 0.08%"
tests "./201yams 6 6 6 6 6 straight_5"      "Chances to get a 5 straight: 0.01%"
tests "./201yams 2 3 4 5 6 straight_6"      "Chances to get a 6 straight: 100.00%"
tests "./201yams 2 3 4 0 6 straight_6"      "Chances to get a 6 straight: 16.67%"
tests "./201yams 2 3 0 0 6 straight_6"      "Chances to get a 6 straight: 2.78%"
tests "./201yams 2 0 0 5 0 straight_6"      "Chances to get a 6 straight: 0.46%"
tests "./201yams 0 0 4 0 0 straight_6"      "Chances to get a 6 straight: 0.08%"
tests "./201yams 1 1 1 1 1 straight_6"      "Chances to get a 6 straight: 0.01%"

# full
tests "./201yams 1 1 1 2 2 full_1_2"    "Chances to get a 1 full of 2: 100.00%"
tests "./201yams 1 1 1 1 2 full_1_2"    "Chances to get a 1 full of 2: 16.67%"
tests "./201yams 1 1 1 1 1 full_1_2"    "Chances to get a 1 full of 2: 2.78%"
tests "./201yams 1 1 2 2 2 full_1_2"    "Chances to get a 1 full of 2: 16.67%"
tests "./201yams 1 2 2 2 2 full_1_2"    "Chances to get a 1 full of 2: 2.78%"
tests "./201yams 2 2 2 2 2 full_1_2"    "Chances to get a 1 full of 2: 0.46%"

tests "./201yams 1 1 1 4 2 full_1_2"    "Chances to get a 1 full of 2: 16.67%"
tests "./201yams 1 1 1 4 4 full_1_2"    "Chances to get a 1 full of 2: 2.78%"
tests "./201yams 1 1 4 2 2 full_1_2"    "Chances to get a 1 full of 2: 16.67%"
tests "./201yams 1 4 4 2 2 full_1_2"    "Chances to get a 1 full of 2: 2.78%"
tests "./201yams 4 4 4 2 2 full_1_2"    "Chances to get a 1 full of 2: 0.46%"

tests "./201yams 1 4 4 4 2 full_1_2"    "Chances to get a 1 full of 2: 1.39%"