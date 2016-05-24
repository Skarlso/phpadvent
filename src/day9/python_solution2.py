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
    yield tuple(pool[i] for i in indices[:r])
    while n:
        for i in reversed(range(r)):
            cycles[i] -= 1
            print(cycles[i])
            if cycles[i] == 0:
                # print("before", indices)
                # print("head", indices[i:])
                # print("front", indices[i+1:])
                # print("back", indices[i:i+1])
                # print("tail", indices[i+1:] + indices[i:i+1])
                indices[i:] = indices[i+1:] + indices[i:i+1]
                # print("after", indices)
                cycles[i] = n - i
                print("No break")
            else:
                j = cycles[i]
                print(indices)
                indices[i], indices[-j] = indices[-j], indices[i]
                yield tuple(pool[i] for i in indices[:r])
                print("break")
                break
        else:

            print("return is called")
            return


arr = [1,2,3]
for v in permutations(arr):
    print('===')
