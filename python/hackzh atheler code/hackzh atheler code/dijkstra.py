import os
os.system('clear')

import numpy as np
import matplotlib.pyplot as plt
import scipy as sp
from scipy.sparse.csgraph import dijkstra


#INTERMEDIATES = [10]
INTERMEDIATES = [10, 0, 8]
INTERMEDIATES = [10]
#intermediates = [0, 11, 4]
START = 1
END = 7


POSITIONS = np.array([
    [0., 2.],
    [1., 0.],
    [1., 1.],
    [1., 2.],
    [1., 3.],
    [2., 2.],
    [3., 2.],
    [4., 0.],
    [4., 1.],
    [4., 2.],
    [4., 3.],
    [5., 2.],
])


EDGES = np.array([
    # Left part
    [0, 4],
    [0, 2],
    [1, 2],
    [2, 3],
    [3, 4],
    [4, 5],
    [2, 5],


    # Middle part
    [4, 10],
    [5, 6],
    [2, 8],

    # Right part
    [6, 10],
    [6, 9],
    [6, 8],
    [10, 11],
    [9, 11],
    [8, 11],
    [8, 7],


])

from moon_shop import EDGES, POSITIONS


EDGES = np.array(EDGES)
POSITIONS_3D = np.array(POSITIONS)
POSITIONS = POSITIONS_3D[:, [0, 2]]
x, y = POSITIONS.T


END = 102
START = 101
print(POSITIONS[START])
print(POSITIONS[END])
INTERMEDIATES = np.random.choice(np.arange(101), size=5)
x, y = POSITIONS.T
POSITIONS = np.array([
    y, x,
]).T


SIZE = 100


def plot_graph(edges, positions):
    x, y = positions.T
    ax.scatter(x, y)

    for edge in edges:
        line = positions[edge]
        (x0, y0), (x1, y1) = line
        plt.plot([x0, x1], [y0, y1], color='gray')


    x, y = POSITIONS[START]
    ax.scatter(x, y, color='green', s=SIZE)
    x, y = POSITIONS[END]
    ax.scatter(x, y, color='red', s=SIZE)


def plot_path(path, positions):
    x, y = positions[path].T
    plt.plot(x, y, lw=4)


def plot_intermediates(intermediates, positions):
    x, y = positions[intermediates].T
    ax.scatter(x, y, s=SIZE)


def graph_matrix(edges, positions):
    n = edges.max() + 1
    graph = np.zeros((n, n))
    for start, end in edges:
        dist = np.linalg.norm(positions[end] - positions[start])
        graph[start, end] = graph[end, start] = dist

    return graph


def find_path(predecessors, start, end):
    """Find best path from start to end node."""
    path = []
    current = start
    while current != end:
        path.append(current)
        current = predecessors[end, current]

    path.append(end)
    return path


def find_best_shopping_tours(graph, start, end, intermediates=None):
    """Find best shopping tour from start to end whilst visiting all of the
    intermediate nodes.
    """
    if intermediates is None:
        intermediates = []
    else:
        intermediates = list(intermediates)

    path = []
    distances, predecessors = dijkstra(graph, directed=False, return_predecessors=True)
    current = start
    while intermediates:
        # Next stop
        i = distances[current, intermediates].argmin()
        nextStop = intermediates[i]
        intermediates.remove(nextStop)

        pathSegment = find_path(predecessors, current, nextStop)
        path.extend(pathSegment[:-1])
        current = pathSegment[-1]

    pathSegment = find_path(predecessors, current, end)
    path.extend(pathSegment)
    return path


if __name__ == '__main__':
    graph = graph_matrix(EDGES, POSITIONS)
    path = find_best_shopping_tours(graph, start=START, end=END, intermediates=INTERMEDIATES)
    print('Shpping tour:', path)

    print('Path vertices:')
    print(repr(POSITIONS_3D[path]))
    print('intermediates vertices:')
    print(repr(POSITIONS_3D[INTERMEDIATES]))

    fig, ax = plt.subplots(1)
    plot_graph(EDGES, POSITIONS)
    plot_intermediates(INTERMEDIATES, POSITIONS)
    plot_path(path, POSITIONS)

    ax.invert_xaxis()
    ax.invert_yaxis()
    ax.set_aspect('equal')
    plt.axis('off')
    
    plt.show()
