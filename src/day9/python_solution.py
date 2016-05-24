import sys
import re
import time

def traverse(cities, visited, current, func):
    visited = visited + [current]

    return (0 if len(cities) == len(visited) else
            func(cities[current][c] + traverse(cities, visited, c, func)
                 for c in cities if c not in visited))


distances = [x.strip() for x in sys.stdin.readlines()]
pattern = r'(.+) to (.+) = ([0-9]+)'
cities = {'Start': {}}

for d in distances:
    city_1, city_2, dist = re.match(pattern, d).groups()

    if city_1 not in cities: cities[city_1] = {}
    if city_2 not in cities: cities[city_2] = {}

    cities['Start'][city_1] = 0
    cities['Start'][city_2] = 0
    cities[city_1][city_2] = int(dist)
    cities[city_2][city_1] = int(dist)

# Part 1
start_time = time.time()
print(traverse(cities, [], 'Start', min))
print(time.time() - start_time)
