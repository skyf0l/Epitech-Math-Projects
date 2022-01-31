#!/usr/bin/env python3

import sys
from typing import Iterable, Tuple, final
import argparse
from argparse import Namespace
from dataclasses import dataclass
from math import factorial
from copy import deepcopy
import math

class ArgumentParser(argparse.ArgumentParser):
    def error(self, message: str) -> None:
        sys.stderr.write(f"error: {message}\n")
        self.print_help()
        sys.exit(84)

def parse_args(argv: Iterable[str]) -> Namespace:
    parser = ArgumentParser(description="Maximize the profit of a farm")
    parser.add_argument("n1", type=int, help="number of tons of fertilizer F1")
    parser.add_argument("n2", type=int, help="number of tons of fertilizer F2")
    parser.add_argument("n3", type=int, help="number of tons of fertilizer F3")
    parser.add_argument("n4", type=int, help="number of tons of fertilizer F4")
    parser.add_argument("po", type=int, help="price of one unit of oat")
    parser.add_argument("pw", type=int, help="price of one unit of wheat")
    parser.add_argument("pc", type=int, help="price of one unit of corn")
    parser.add_argument("pb", type=int, help="price of one unit of barley")
    parser.add_argument("ps", type=int, help="price of one unit of soy")
    parser.add_argument("-g", "--graphic", dest="graphic", action="store_true",
                        help="Show a window of the results")
    result: Namespace = parser.parse_args(argv[1:])
    if result.n1 < 0 or result.n2 < 0 or result.n3 < 0 or result.n4 < 0 or result.po < 0 or result.pw < 0 or result.pc < 0 or result.pb < 0 or result.ps < 0:
        parser.error("All numbers must be positive")
    return result

@dataclass
class EndData:
    oat: float = 0
    wheat: float = 0
    corn: float = 0
    barley: float = 0
    soy: float = 0
    total: float = 0

FERT: list[list[int]] = [
    [1, 1, 2, 0],
    [0, 2, 1, 0],
    [1, 0, 0, 3],
    [0, 1, 1, 1],
    [2, 0, 0, 2],
]

BASE_MATRIX: list[list[float]] = [
    [FERT[0][0], FERT[1][0], FERT[2][0], FERT[3][0], FERT[4][0], 1, 0, 0, 0],
    [FERT[0][1], FERT[1][1], FERT[2][1], FERT[3][1], FERT[4][1], 0, 1, 0, 0],
    [FERT[0][2], FERT[1][2], FERT[2][2], FERT[3][2], FERT[4][2], 0, 0, 1, 0],
    [FERT[0][3], FERT[1][3], FERT[2][3], FERT[3][3], FERT[4][3], 0, 0, 0, 1],
    [0, 0, 0, 0, 0],
]

def get_piv(matrix: list[list[float]]) -> tuple[float, float]:
    max_y = len(matrix)
    max_x = len(matrix[0])
    line = matrix[max_y - 1]
    copy_line = deepcopy(line)
    min_v = 999999999999999999999 # TODO: Replace this garbage right here
    for i in copy_line:
        if i < min_v:
            min_v = i
    if min_v >= 0:
        return -1, -1
    piv_x = -1
    piv_y = -1
    got_it = False
    for i in range(len(copy_line)):
        if copy_line[i] == min_v:
            piv_x = i
            got_it = True
            break
    if not got_it:
        piv_x = len(copy_line)
    min_v = 999999999999999999999
    for i in range(max_y - 1):
        if matrix[i][max_x - 1] != 0:
            if matrix[i][piv_x] > 0 and matrix[i][max_x - 1] / matrix[i][piv_x] < min_v and matrix[i][max_x - 1] / matrix[i][piv_x] > 0:
                piv_y = i
                min_v = matrix[i][max_x - 1] / matrix[i][piv_x]
        elif min_v > matrix[i][piv_x] and matrix[i][piv_x] > 0:
            piv_y = i
            min_v = matrix[i][max_x - 1] / matrix[i][piv_x]
    return (piv_y, piv_x)

def exec_piv(matrix: list[list[float]], y: float, x: float) -> list[list[float]]:
    piv = matrix[y][x]
    for i in range(len(matrix[y])):
        matrix[y][i] /= piv
    max_y = len(matrix)
    max_x = len(matrix[0])
    for i in range(max_y):
        if i == y:
            continue
        val = matrix[i][x]
        for j in range(max_x):
            matrix[i][j] -= val * matrix[y][j]
    return matrix


def do_maths(config: Namespace, matrix: list[list[float]]) -> EndData:
    # Do something here

    tmp_arr = [-1] * 4

    i = 0

    while True:
        i += 1
        if i == 6:
            break
        y_p, x_p = get_piv(matrix)
        if (y_p == -1 or x_p == -1):
            break
        matrix = exec_piv(matrix, y_p, x_p)
        tmp_arr[y_p] = x_p

    end_data = [0] * 5

    for i in range(len(tmp_arr)):
        if tmp_arr[i] != -1:
            end_data[tmp_arr[i]] = matrix[i][-1]

    # Get the end data

    return EndData(
        oat=end_data[0],
        wheat=end_data[1],
        corn=end_data[2],
        barley=end_data[3],
        soy=end_data[4],
        total= (
            end_data[0] * config.po +
            end_data[1] * config.pw +
            end_data[2] * config.pc +
            end_data[3] * config.pb +
            end_data[4] * config.ps
        ),
    )

def gen_final_matrix(config: Namespace) -> list[list[float]]:
    final_matrix = BASE_MATRIX
    final_matrix[0].append(config.n1)
    final_matrix[1].append(config.n2)
    final_matrix[2].append(config.n3)
    final_matrix[3].append(config.n4)
    final_matrix[4] = [
        -config.po,
        -config.pw,
        -config.pc,
        -config.pb,
        -config.ps,
    ] + final_matrix[4]
    return final_matrix

def print_ressource(name: str, ressource: float, price: int) -> None:
    if ressource == 0:
        print(f"{name}: 0 units at ${price}/unit")
    else:
        print(f"{name}: {ressource:.2f} units at ${price}/unit")

def print_end_data(config: Namespace, end_data: EndData) -> None:
    print(f"Resources: {config.n1} F1, {config.n2} F2, {config.n3} F3, {config.n4} F4\n")
    print_ressource("Oat", end_data.oat, config.po)
    print_ressource("Wheat", end_data.wheat, config.pw)
    print_ressource("Corn", end_data.corn, config.pc)
    print_ressource("Barley", end_data.barley, config.pb)
    print_ressource("Soy", end_data.soy, config.ps)
    print(f"\nTotal production value: ${end_data.total:.2f}")

def main(argv: Iterable[str]) -> int:
    config: Namespace = parse_args(argv)
    final_matrix = gen_final_matrix(config)
    end_data: EndData = do_maths(config, final_matrix)
    if not end_data:
        return 84
    if config.graphic:
        raise NotImplementedError("Graphic mode not implemented yet")
    else:
        print_end_data(config, end_data)
    return 0

if __name__ == "__main__":
    sys.exit(main(sys.argv))
