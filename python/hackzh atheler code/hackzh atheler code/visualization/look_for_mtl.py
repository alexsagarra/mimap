import os



for dirpath, dirnames, filenames in os.walk('three.js-master'):
    for fn in filenames:
        if 'MTLLoader' in fn:
            print(os.path.join(dirpath, fn))
