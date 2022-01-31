import math
import sys


def display_plot_array(data: list):
    for i in range(len(data)):
        print(f"{i} {data[i]:.5f}")


def calculate_value(mean: int, standard_deviation: int, x: float) -> float:
    return math.exp(-((x - mean) ** 2) / (2 * (standard_deviation ** 2))) / \
           (standard_deviation * math.sqrt(2 * math.pi))


def calculate_plot_data(mean: int, standard_deviation: int, minimum=0, maximum=201) -> list:
    data = []
    for i in range(minimum, maximum):
        data.append(calculate_value(mean, standard_deviation, i))
    return data


def inferior_result(mean: int, standard_deviation: int, minimum: int) -> int:
    if mean < 0 or mean > 200 or standard_deviation < 0 or minimum < 0 or minimum > 200:
        return 84
    result = 0
    i = 0
    while i < minimum:
        result += calculate_value(mean, standard_deviation, i)
        i += 0.01
    print(f"{result:.1f}% of people have an IQ inferior to {minimum}")
    return 0


def interval_result(mean: int, standard_deviation: int, minimum: int, maximum: int) -> int:
    if mean < 0 or mean > 200 or standard_deviation < 0 or minimum < 0 or maximum > 201 or maximum < minimum:
        return 84
    result = 0
    i = minimum
    while i < maximum:
        result += calculate_value(mean, standard_deviation, i)
        i += 0.01
    print(f"{result:.1f}% of people have an IQ between {minimum} and {maximum}")
    return 0


def simple_result(mean: int, standard_deviation: int) -> int:
    if mean < 0 or mean > 200 or standard_deviation < 0:
        return 84
    data = calculate_plot_data(mean, standard_deviation)
    display_plot_array(data)
    return 0


def print_help() -> int:
    print("USAGE")
    print("\t./205IQ u s [IQ1] [IQ2]")
    print("")
    print("DESCRIPTION")
    print("\tu\tmean")
    print("\ts\tstandard deviation")
    print("\tIQ1\tminimum IQ")
    print("\tIQ2\tmaximum IQ")
    return 0


def main(argc: int, argv: list) -> int:
    try:
        if argc == 2:
            if argv[1] == "-h":
                return print_help()
            raise RuntimeError()
        elif argc == 3:
            return simple_result(int(argv[1]), int(argv[2]))
        elif argc == 4:
            return inferior_result(int(argv[1]), int(argv[2]), int(argv[3]))
        elif argc == 5:
            return interval_result(int(argv[1]), int(argv[2]), int(argv[3]), int(argv[4]))
        else:
            return 84
    except ValueError:
        return 84
    except RuntimeError:
        return 84


if __name__ == "__main__":
    exit(main(len(sys.argv), sys.argv))
