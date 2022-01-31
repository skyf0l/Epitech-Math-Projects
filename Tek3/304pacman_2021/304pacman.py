#!/usr/bin/env python3

import sys


class Grid:
    EMPTY = 0
    WALL = -1
    PLAYER = -2
    GHOST = -3

    def __init__(self, file_path) -> None:
        self.load_grid(file_path)

    def load_grid(self, file_path: str) -> None:
        raw_grid = open(file_path).read().strip().split('\n')

        self.grid = []
        self.player = None
        self.ghost = None

        for y in range(len(raw_grid)):
            self.grid.append([])

            if y != 0:
                assert len(raw_grid[y]) == len(raw_grid[y - 1]), 'Grid is not rectangular'

            for x in range(len(raw_grid[y])):
                c = raw_grid[y][x]
                if c == '0':
                    self.grid[-1].append(self.EMPTY)
                elif c == '1':
                    self.grid[-1].append(self.WALL)
                elif c == 'P':
                    assert self.player is None, "Multiple players"
                    self.grid[-1].append(self.PLAYER)
                    self.player = (x, y)
                elif c == 'F':
                    assert self.ghost is None, "Multiple ghosts"
                    self.grid[-1].append(self.GHOST)
                    self.ghost = (x, y)
                else:
                    raise ValueError("Invalid character in grid")

        assert self.player is not None, "No player position found"
        assert self.ghost is not None, "No ghost position found"

    def dijkstra(self, start_pos: tuple, end_pos: tuple) -> bool:
        # Dijkstra's algorithm

        # Initialize
        visited = set()
        queue = [(start_pos, 0)]

        # Loop until the queue is empty (not path) or the end is found
        while queue:
            pos, dist = queue.pop(0)

            # Continue if the position has already been visited
            if pos in visited:
                continue
            visited.add(pos)

            # Check if the end is found and return True if it is
            if pos == end_pos:
                # Path found
                return True

            # Visualization of the algorithm (expected by the 304pacman)
            if self.grid[pos[1]][pos[0]] == self.EMPTY:
                self.grid[pos[1]][pos[0]] = dist

            # Add the neighbors to the queue (N, E, S, W)
            moves = [(0, -1), (1, 0), (0, 1), (-1, 0)]
            for move in moves:
                x, y = pos
                x += move[0]
                y += move[1]

                # Check if the neighbor is outside the grid
                if not (0 <= y < len(self.grid) and 0 <= x < len(self.grid[y])):
                    continue

                # Check if the neighbor is a wall
                if self.grid[y][x] in [self.EMPTY, self.PLAYER]:
                    # Add the neighbor to the queue
                    queue.append(((x, y), dist + 1))

        # Path not found
        return False

    def print(self, c1: str, c2: str) -> None:
        assert len(c1) == 1, "c1 must be a single character"
        assert len(c2) == 1, "c2 must be a single character"

        for l in self.grid:
            for c in l:
                if c == self.EMPTY:
                    print(c2, end='')
                elif c == self.WALL:
                    print(c1, end='')
                elif c == self.PLAYER:
                    print('P', end='')
                elif c == self.GHOST:
                    print('F', end='')
                elif c > 0:
                    print(str(c % 10), end='')
                else:
                    raise ValueError("Invalid character in grid")
            print()


def print_usage() -> None:
    print("USAGE")
    print("\t./304pacman file c1 c2")
    print("\nDESCRIPTION")
    print("\tfile file describing the board, using the following characters:")
    print("\t\t'0' for an empty square,")
    print("\t\t'1' for a wall,")
    print("\t\t'F' for the ghost's position,")
    print("\t\t'P' for Pacman's position.")
    print("\tc1 character to display for a wall")
    print("\tc2 character to display for an empty space.")


if __name__ == "__main__":
    try:
        if len(sys.argv) == 2 and sys.argv[1] == "-h":
            # print help
            print_usage()
        elif len(sys.argv) == 4:
            grid = Grid(sys.argv[1])
            grid.dijkstra(grid.ghost, grid.player)
            grid.print(sys.argv[2], sys.argv[3])
        else:
            raise Exception('Wrong number of arguments')
    except Exception as e:
        print(e, file=sys.stderr)
        print('Try ./304pacman -h', file=sys.stderr)
        sys.exit(84)
