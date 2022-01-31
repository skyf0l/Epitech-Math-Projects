def selection_sort(comparison_func, numbers: list) -> int:
    num_comp = 0
    for i in range(len(numbers)):
        y = i
        for j in range(i + 1, len(numbers)):
            num_comp += 1
            if comparison_func(numbers[j], numbers[y]):
                y = j
        numbers[i], numbers[y] = numbers[y], numbers[i]
    return num_comp


def insertion_sort(comparison_func, numbers: list) -> int:
    num_comp = 0
    for i in range(1, len(numbers)):
        for n in range(i):
            num_comp += 1
            if comparison_func(numbers[i], numbers[n]):
                numbers.insert(n, numbers[i])
                numbers.pop(i + 1)
                break
    return num_comp


def bubble_sort(comparison_func, numbers: list) -> int:
    num_comp = 0
    for i in range(len(numbers) - 1, 0, -1):
        for j in range(0, i, 1):
            num_comp += 1
            if comparison_func(numbers[j + 1], numbers[j]):
                numbers[j], numbers[j + 1] = numbers[j + 1], numbers[j]
    return num_comp


num_comp_quick = 0


def quick_sort(comparison_func, numbers: list):
    inner_quick(comparison_func, numbers)
    return num_comp_quick

def inner_quick(comparison_func, numbers: list):
    less = []
    equal = []
    greater = []
    global num_comp_quick
    if len(numbers) > 1:
        pivot = numbers[0]
        for x in numbers[1:]:
            num_comp_quick += 1
            if comparison_func(x, pivot):
                less.append(x)
            else:
                greater.append(x)
        return inner_quick(comparison_func, less) + equal + inner_quick(comparison_func, greater)
    else:
        return numbers


num_comp_merge = 0


def merge(left, right) -> list:
    global num_comp_merge
    if left == []:
        return right
    if right == []:
        return left
    if left[0] < right[0]:
        num_comp_merge += 1
        return [left[0]] + merge(left[1 :], right)
    else:
        num_comp_merge += 1
        return [right[0]] + merge(left, right[1:])


def inner_merge(numbers) -> list:
    if len(numbers) > 1:
        median = len(numbers) // 2
        return merge(inner_merge(numbers[:median]), inner_merge(numbers[median:]))
    return numbers


# TODO: Use comparison func
def merge_sort(comparison_func, numbers: list) -> int:
    inner_merge(numbers)
    return num_comp_merge
