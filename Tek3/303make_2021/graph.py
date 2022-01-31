##
# EPITECH PROJECT, 2021
# 302separation
# File description:
# graph
##

from typing import DefaultDict


class Graph:
    def __init__(self, size: int):
        assert size >= 1
        self.size = size
        self.matrix = [[0 for _ in range(size)] for i in range(size)]
        self.reversed_matrix = [[0 for _ in range(size)] for i in range(size)]
        self.nodes = set(i for i in range(size))
        self.edges = DefaultDict(list)
        self.distances = {}

    def __len__(self) -> int:
        return self.size

    def __str__(self) -> str:
        result = ""
        for i in range(self.size):
            for y in range(self.size - 1):
                result += f"{self.matrix[i][y]} "
            result += f"{self.matrix[i][self.size - 1]}"
            if i != self.size - 1:
                result += "\n"
        return result

    def add_edge(self, a: int, b: int, allow_loop: bool = False, single_direction: bool = False) -> None:
        if not allow_loop and a == b:
            raise ValueError("Loop is not allowed")

        self.edges[a].append(b)
        self.distances[(a, b)] = 1

        if not single_direction:
            self.edges[b].append(a)
            self.distances[(b, a)] = 1

    def gen_matrix(self) -> None:
        for i in range(self.size):
            for j in range(self.size):
                if j in self.edges[i]:
                    self.matrix[i][j] = self.distances[(i, j)]
                    self.reversed_matrix[j][i] = self.distances[(i, j)]

    def get_paths(self, a: int):
        visited = {a: 0}
        path = {}
        nodes = set(self.nodes)

        while nodes:
            min_node = None
            for node in nodes:
                if node in visited:
                    if min_node is None:
                        min_node = node
                    elif visited[node] < visited[min_node]:
                        min_node = node

            if min_node is None:
                break

            nodes.remove(min_node)
            current_weight = visited[min_node]

            for edge in self.edges[min_node]:
                try:
                    weight = current_weight + self.distances[(min_node, edge)]
                except:
                    continue
                if edge not in visited or weight < visited[edge]:
                    visited[edge] = weight
                    path[edge] = min_node

        return visited

    def gen_distances(self, max: int) -> None:
        for i in range(self.size):
            tmp = self.get_paths(i)
            for key, j in tmp.items():
                if j > max:
                    self.matrix[i][key] = 0
                else:
                    self.matrix[i][key] = j
