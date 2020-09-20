import collections
import json
import logging
import requests

import requests
from requests.auth import HTTPBasicAuth

from tree import Node, print_tree



ENDPOINT = 'https://hackzurich-api.migros.ch'


USERNAME = 'hackzurich2020'
PASSWORD = 'uhSyJ08KexKn4ZFS'
AUTH = HTTPBasicAuth(USERNAME, PASSWORD)
#AUTH = (USERNAME, PASSWORD)
fmtCatTree = '/category-tree/{id}?depth={depth}'



def request(url, method='get', **kwargs):
    """Request something."""
    func = getattr(requests, method)
    response = func(url, auth=AUTH, **kwargs)
    payload = response.json()
    if not response.ok:
        print('Response not ok')

    return payload


def query_category_tree(id, depth=3):
    url = ENDPOINT + 'category-tree/{id}?depth={depth}'.format(id=id, depth=depth)
    return request(url)


def query_category(id):
    #print('query_category()', id)
    url = ENDPOINT + '/categories/{id}'.format(id=id)
    return request(url)


def query_categories(limit=1000, offset=0):
    url = ENDPOINT + f'/categories?limit={limit}&offset={offset}&sort=code&order=asc&view=browse&custom_image=false'
    return request(url)


def query_all_categories():
    limit = 500
    offset = 0
    categories = []
    while True:
        res = query_categories(limit=limit, offset=offset)
        cats = res['categories']
        categories.extend(cats)
        if len(cats) < limit:
            break

        offset += limit

    return categories


if __name__ == '__main__':
    #url = ENDPOINT + fmtCatTree.format(id=0, depth=3)
    #url = ENDPOINT + '/categories'
    #url = "https://hackzurich-api.migros.ch/category-tree/0?depth=2"

    #foo = requests.get(url, auth=AUTH)
    #res = request(url)
    #print(res)



    """
    queue = collections.deque(['root'])

    code2node = {}
    while queue:
        code = queue.popleft()
        res = query_category(id=code)
        if 'parent_code' in res:
            parent = code2node[res['parent_code']]
        else:
            parent = None

        node = Node(parent=parent, res=res)

        indent = len(list(node.upstream())) * ' '
        print(indent, node)

        code2node[code] = node
        if 'children' in res:
            queue.extend([
                dct['code'] for dct in res['children']
            ])

    root = code2node['root']
    print_tree(root)
    """


    """
    res = query_category('root')
    root = parent = Node(code=res['code'])

    code2node = {
        'root': root,
    }

    queue = collections.deque([
        dct['code'] for dct in res[]
    ])
    """

    """

    for childDct in res['children']:
        child = Node(parent=parent, code=childDct['code'])
    """

    #with open('cats.json', 'w') as f:
    #    json.dump(categories, f)

    with open('categories.json', 'r') as f:
        categories = json.load(f)

    parents = {}
    nodes = {}
    for dct in categories:
        code = dct['code']
        node = Node(data=dct)
        nodes[code] = node

        if 'ancestors' in dct:
            parents[code] = dct['ancestors'][0]['code']


    for childCode, parentCode in parents.items():
        parent = nodes[parentCode]
        child = nodes[childCode]
        parent.add_child(child)

    root = nodes['root']
    #print_tree(root)


    supermarkt = root.children[0]

    queue = collections.deque([(supermarkt, 0)])
    count = 0
    maxDepth = 3
    while queue:
        node, level = queue.popleft()
        if level < maxDepth:
            count += 1
            print(level * '  ', node.data['name'])
            for child in node.children:
                queue.appendleft((child, level+1))

    print('count:', count)
