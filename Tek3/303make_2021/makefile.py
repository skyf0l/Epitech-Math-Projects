#!/usr/bin/env python3

from graph import Graph


def format_lines(lines: list) -> list:
    formated_lines = []

    for line in lines:
        # strip line
        line = line.strip()

        # remove comments
        if line.find("#") != -1:
            line = line[:line.find("#")]

        # remove tabs
        line = line.replace("\t", " ")
        # remove multiple spaces
        while line.find("  ") != -1:
            line = line.replace("  ", " ")

        # ignore empty lines
        if line == "":
            continue

        # append line to formated lines
        formated_lines.append(line)

    return formated_lines


class Makefile:

    def __init__(self, filename: str) -> None:
        self.filename = filename
        self.__parseFile()

        self.__generateGraph()
        self.__generateDependencies()

    def __generateSortedNames(self, raw_target_dependency: list) -> list:
        self.sorted_names = []
        for i in raw_target_dependency:
            for y in i:
                if y not in self.sorted_names:
                    self.sorted_names.append(y)
        self.sorted_names.sort()
        return self.sorted_names

    def __parseFile(self) -> None:
        self.raw_target_dependency = []
        self.compilation_commands = {}

        # open and read Makefile
        with open(self.filename, "r") as f:
            raw_lines = f.read().split("\n")
            raw_lines = format_lines(raw_lines)

            # iterate over lines
            i = 0
            while i < len(raw_lines):
                line = raw_lines[i]

                if line.find(":") != -1 and line.count(":") == 1:
                    # get target and dependencies
                    target, dependencies = line.split(":")
                    dependencies = [dependency.strip()
                                    for dependency in dependencies.split(" ")]
                    dependencies.remove("")

                    if len(target) == 0:
                        raise Exception("Invalid file format: empty target")

                    # extract compilation commands
                    commands = []
                    while i + 1 < len(raw_lines) and raw_lines[i + 1].find(":") == -1:
                        commands.append(raw_lines[i + 1])
                        i += 1

                    # add to raw data
                    for dependency in dependencies:
                        self.raw_target_dependency.append([target, dependency])
                    # add compilation commands
                    self.compilation_commands[target] = commands
                else:
                    raise Exception("Invalid file format: expected rule line")

                i += 1

            if len(self.raw_target_dependency) == 0:
                raise Exception("Empty file")
            self.__generateSortedNames(self.raw_target_dependency)

    def __generateGraph(self) -> None:
        # create graph
        self.graph = Graph(len(self.sorted_names))
        for i in self.raw_target_dependency:
            try:
                self.graph.add_edge(self.sorted_names.index(i[0]),
                                    self.sorted_names.index(i[1]),
                                    single_direction=True)
            except ValueError:
                raise Exception("Invalid Makefile: dependencies loop")
        self.graph.gen_matrix()

    def getDependenciesOf(self, file: str) -> list:
        dependencies = []

        file_index = self.sorted_names.index(file)
        for i in range(self.graph.size):
            if self.graph.reversed_matrix[file_index][i] == 1:
                dependency = [self.sorted_names[i]]
                # get dependencies of dependency recursively
                sub_dependencies = self.getDependenciesOf(self.sorted_names[i])

                if len(sub_dependencies) == 0:
                    # end of recursion
                    dependencies.append(dependency)
                else:
                    # add all sub dependencies
                    for sub_dependency in sub_dependencies:
                        dependencies.append(dependency + sub_dependency)
        return dependencies

    def __generateDependencies(self) -> None:
        self.dependencies = []

        try:
            for i in self.sorted_names:
                dependencies = self.getDependenciesOf(i)
                for dependency in dependencies:
                    self.dependencies.append([i] + dependency)
        except RecursionError:
            raise Exception("Invalid Makefile: dependencies loop")

    def printGraph(self) -> None:
        # print graph matrix
        for i in range(self.graph.size):
            print(f"[{' '.join(map(str, self.graph.reversed_matrix[i]))}]")
        print()

        # print dependencies
        for dependency in self.dependencies:
            print(' -> '.join(dependency))

    def printDependencies(self, file: str) -> None:
        if file not in self.sorted_names:
            raise Exception("Invalid Makefile: file not found")

        # get dependencies of file
        commands = []
        for dependency in self.dependencies:
            if dependency[0] == file:
                for d in dependency:
                    if d in self.compilation_commands:
                        commands += self.compilation_commands[d]

        # remove duplicates
        i = 0
        while i < len(commands):
            if commands[i] in commands[i + 1:]:
                commands.remove(commands[i])
                i -= 1
            i += 1

        print('\n'.join(commands))
