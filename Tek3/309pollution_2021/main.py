#!/usr/bin/env python3

from sys import argv, exit
from math import factorial
import csv

def bezier(x: int, y: int, grid: list, degree: int) -> float:
    pollution = 0
    for i in range(degree + 1):
        for j in range(degree + 1):
            pollution += (
                poly_bernstein(degree, i, y) *
                poly_bernstein(degree, j, x) *
                grid[i][j]
            )
    return pollution


def poly_bernstein(n: int, k: int, p: int) -> float:
    a: int = int(factorial(n) / (factorial(k) * factorial(n - k)))
    if k == 0:
        b = 1
    else:
        b = pow(p, k)
    if n - k == 0:
        c = 1
    else:
        c = pow((1 - p), (n - k))
    return a * b * c


def is_in_grid(index: int, size: int) -> bool:
    return 0 <= index < size


def parse_file(filepath: str, size: int) -> list:
    try:
        p_list: list = []
        with open(filepath, "r") as f:
            reader = csv.reader(f, delimiter=";")
            for row in reader:
                p_list.append(list(map(int, row)))
    except:
        exit(84)
    to_return = []
    for _ in range(0, size):
        to_return.append([0] * size)
    for p in p_list:
        if not is_in_grid(p[0], size) or not is_in_grid(p[1], size):
            exit(84)
        to_return[p[1]][p[0]] = p[2]
    return to_return


if __name__ == "__main__":
    if len(argv) == 2 and argv[1] == "--help":
        print("usage: 309pollution [--help]")
    elif len(argv) == 5:

        # Get arguments
        try:
            x: float = float(argv[3])
            y: float = float(argv[4])
            size: int = int(argv[1])
        except ValueError:
            exit(84)
        filepath: str = argv[2]

        # Check arguments

        if size <= 0 or size == 1:
            exit(84)
        x /= size - 1
        y /= size - 1
        if x < 0 or x > size - 2 or y < 0 or y > size - 2:
            exit(84)

        # Parse file

        grid: list = parse_file(filepath, size)

        # Compute pollution

        pollution: float = bezier(x, y, grid, size - 1)
        print(f"{pollution:.2f}")
    else:
        exit(84)
