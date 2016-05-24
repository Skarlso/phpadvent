def permutations(iterable, r=None):
    # permutations('ABCD', 2) --> AB AC AD BA BC BD CA CB CD DA DB DC
    # permutations(range(3)) --> 012 021 102 120 201 210
    pool = tuple(iterable)
    n = len(pool)
    r = n if r is None else r
    if r > n:
        return
    indices = range(n)
    cycles = range(n, n-r, -1)
    arr = []
    for i in indices[:r]:
        print(i)
        arr.append(pool[i])

    yield tuple(arr)
    while n:
        for i in reversed(range(r)):
            cycles[i] -= 1
            if cycles[i] == 0:
                # It's i:i+1 so it becomes an array and it can be added together.
                indices[i:] = indices[i+1:] + indices[i:i+1]
                cycles[i] = n - i
                print(indices)
            else:
                j = cycles[i]
                indices[i], indices[-j] = indices[-j], indices[i]
                yield tuple(pool[i] for i in indices[:r])
                print(indices)
                break
        else:
            print("return is called")
            return


arr = [1,2,3,4]
for v in permutations(arr):
    print("---")
