import numpy as np
import matplotlib.pyplot as plt
import scipy as sp
import time
from scipy.spatial.distance import cdist, pdist
from PIL import Image


# Parms
IMAGE_PATH = 'topdown.png'
FLOOR_PLAN_WIDTH = 3805
FLOOR_PLAN_HEIGHT = 2382
RADIUS = 100.



img = np.array(Image.open(IMAGE_PATH))
imgHeight, imgWidth, _ = img.shape


POSITIONS = []
EDGES = []
START = None
PREV_PT = None


def map_location(pt):
    """Image -> floor locations in 3d."""
    x, y = pt
    return [
        y / imgHeight * FLOOR_PLAN_HEIGHT,
        0,
        -x / imgWidth * FLOOR_PLAN_WIDTH,
    ]


def setdefault_node(loc):
    if len(POSITIONS) == 0:
        POSITIONS.append(loc)
        return 0

    dist = cdist([loc], POSITIONS).ravel()
    i = dist.argmin()
    if dist[i] < RADIUS:
        print('match')
        return i

    i = len(POSITIONS)
    POSITIONS.append(loc)
    return  i


def on_click(event):
    global START, PREV_PT
    if event.xdata is None or event.ydata is None:
        START = None
        return

    pt = event.xdata, event.ydata
    loc = map_location(pt)
    START = setdefault_node(loc)
    PREV_PT = pt


fig, ax = plt.subplots()


def draw_line(start, end):
    x0, y0 = start
    x1, y1 = end
    ax.plot([x0, x1], [y0, y1])
    ax.figure.canvas.draw()


def on_release(event):
    global START
    if event.xdata is None or event.ydata is None:
        START = None
        return

    if START is None:
        return

    pt = event.xdata, event.ydata
    loc = map_location(pt)
    end = setdefault_node(loc)

    draw_line(PREV_PT, pt)

    EDGES.append([START, end])
    START = None


if __name__ == '__main__':
    fig.canvas.mpl_connect('button_press_event', on_click)
    fig.canvas.mpl_connect('button_release_event', on_release)
    ax.imshow(img)
    try:
        """
        plt.ion()
        while True:
            #plt.show()
            time.sleep(0.05)
        """
        plt.show()
        
    finally:
        print('POSITIONS')
        print(POSITIONS)
        print('EDGES')
        print(EDGES)
