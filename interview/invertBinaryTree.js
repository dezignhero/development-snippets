/*

INVERT A BINARY TREE (Google Question) - https://leetcode.com/problems/invert-binary-tree/

Invert a binary tree from

     4
   /   \
  2     7
 / \   / \
1   3 6   9

	to

     4
   /   \
  7     2
 / \   / \
9   6 3   1
*/

// Let's assume format node = { value: <number>, left: <node>/null, right: <node>/null }

function invertBinaryTree(rootNode) {
	if (rootNode) {
		var leftInverted = invertBinaryTree(rootNode.left),
			rightInverted = invertBinaryTree(rootNode.right);

		if (leftInverted) {
			rootNode.right = leftInverted;
		} else {
			delete rootNode.right;
		}

		if (rightInverted) {
			rootNode.left = rightInverted;
		} else {
			delete rootNode.left;
		}
	}

	return rootNode;
}

function invertBinaryTreeWithNull(rootNode) {
	if (rootNode) {
		var leftInverted = invertBinaryTreeWithNull(rootNode.left),
			rightInverted = invertBinaryTreeWithNull(rootNode.right);

		rootNode.right = leftInverted;
		rootNode.left = rightInverted;
	}

	return rootNode ? rootNode : null;
}

// Sample Binary Tree

var tree = {
	value: 4,
	left: {
		value: 2,
		left: {
			value: 1
		},
		right: {
			value: 3
		}
	},
	right: {
		value: 7,
		left: {
			value: 6
		},
		right: {
			value: 9
		}
	}
}
