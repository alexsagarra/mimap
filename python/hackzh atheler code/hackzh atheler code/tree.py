import collections


class Node:
    def __init__(self, children=None, parent=None, data=None):
        self.children = []
        self.parent = None
        self.data = data
        if children:
            for child in children:
                self.add_child(child)

        if parent:
            parent.add_child(self)

    @property
    def root(self):
        for node in self.upstream():
            pass

        return node

    def add_child(self, child):
        assert child not in self.children
        self.children.append(child)
        child.parent = self

    def dfs(self):
        """Depth-first search"""
        queue = collections.deque([self])
        while queue:
            node = queue.pop()
            yield node
            queue.extend(reversed(node.children))

    def bfs(self):
        """Breadth-first search"""
        queue = collections.deque([self])
        while queue:
            node = queue.popleft()
            yield node
            queue.extend(node.children)

    def upstream(self):
        node = self
        while node:
            yield node
            node = node.parent

    def __str__(self):
        return '{name}'.format(**self.data)


def print_tree(root, indent='  '):
    queue = collections.deque([(root, 0)])
    while queue:
        node, level = queue.popleft()
        print('%s%s' % (level * indent, node))
        for child in reversed(node.children):
            queue.appendleft((child, level + 1))
