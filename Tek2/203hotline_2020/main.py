import math
from functools import lru_cache
import decimal
import time


def float_range(start, stop, step):
    while start < stop:
        yield float(start)
        start += decimal.Decimal(step)


def helper():
    print("USAGE")
    print("\t./203hotline [n k | d]")
    print("\nDESCRIPTION")
    print("\tn\t\tn value for the computation of C(n, k)")
    print("\tk\t\tk value for the computation of C(n, k)")
    print("\td\t\taverage duration of calls (in seconds)")


@lru_cache(maxsize=None)
def c(n: int, k: int):
    return math.factorial(n) // (math.factorial(k) * math.factorial(n - k))


def easy_prob(n: str, k: str) -> int:
    try:
        n = int(n)
        k = int(k)
    except ValueError:
        return 84
    if k > n:
        return 84
    print(f"{k}-combinations of a set of size {n}:")
    print(c(n, k))
    return 0


def display_prob(overload: float, computation_time: float, data: list):
    for i in range(0, 49, 5):
        print(f"{i} -> {data[i]:.3f}\t{i+1} -> {data[i+1]:.3f}\t{i+2} -> {data[i+2]:.3f}\t{i+3} -> {data[i+3]:.3f}\t{i+4} -> {data[i+4]:.3f}")
    print(f"50 -> {data[50]:.3f}")
    print(f"Overload: {overload:.1f}%")
    print(f"Computation time: {computation_time:.2f} ms")


def complete_prob(minutes: str) -> int:
    try:
        minutes = int(minutes)
    except ValueError:
        return 84
    # Handle binomial distribution
    data = []
    overload = 0.
    start_time = time.time()
    p = minutes / (60 * 60 * 8)
    for i in range(51):
        data.append(c(3500, i) * (p ** i) * ((1 - p) ** (3500 - i)))
        if i > 25:
            overload += data[len(data) - 1]
    if minutes > 320:
        overload = 1.
    print("Binomial distribution:")
    display_prob(overload * 100, (time.time() - start_time) * 1000, data)
    # Handle Poisson distribution
    data = []
    overload = 0.
    start_time = time.time()
    p = 3500 * (minutes / (60 * 60 * 8))
    for i in range(51):
        data.append(math.exp(-p) * (p ** i) / math.factorial(i))
        if i > 25:
            overload += data[len(data) - 1]
    if minutes > 320:
        overload = 1.
    print("\nPoisson distribution:")
    display_prob(overload * 100, (time.time() - start_time) * 1000, data)
    return 0


def main(argv: list) -> int:
    if len(argv) not in [2, 3]:
        helper()
        return 84
    if argv[1] == "-h":
        helper()
        return 0
    if len(argv) == 2:
        return complete_prob(argv[1])
    return easy_prob(argv[1], argv[2])
