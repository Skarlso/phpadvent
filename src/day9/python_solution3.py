import sys
from itertools import permutations
from datetime import datetime

places = set()
distances = dict()
for line in open('input.txt'):
    (source, _, dest, _, distance) = line.split()
    places.add(source)
    places.add(dest)
    distances.setdefault(source, dict())[dest] = int(distance)
    distances.setdefault(dest, dict())[source] = int(distance)

shortest = sys.maxsize
longest = 0
for items in permutations(places):
    dist = sum(map(lambda x, y: distances[x][y], items[:-1], items[1:]))
    shortest = min(shortest, dist)
    longest = max(longest, dist)

startTime = datetime.now()
print("shortest: %d" % (shortest))
print(datetime.now() - startTime)
