import numpy as np
import matplotlib.pyplot as plt
import scipy as sp
import pywavefront


"""
FILEPATH = 'Filiale.obj'


if __name__ == '__main__':
    scene = pywavefront.Wavefront(FILEPATH)
"""


ll = np.array([  -12.775791,  -100.      , -3781.001221])
ur = np.array([2370.174072,  430.      ,   24.52775 ])
center = .5 * (ur - ll)
print('center:', center)
