import numpy as np
import matplotlib.pyplot as plt
import cv2

def generate_maze(width, height, complexity=0.2, density=0.2):
    shape = (height // 2 * 2 + 1, width // 2 * 2 + 1)  
    maze = np.zeros(shape, dtype=bool)

    complexity = int(complexity * (5 * (shape[0] + shape[1])))  
    density = int(density * ((shape[0] // 2) * (shape[1] // 2)))  

    maze[0, :] = maze[-1, :] = maze[:, 0] = maze[:, -1] = 1  

    for _ in range(density):
        x, y = np.random.randint(0, shape[1] // 2) * 2, np.random.randint(0, shape[0] // 2) * 2  
        maze[y, x] = 1

        for _ in range(complexity):
            neighbors = []
            if x > 1: neighbors.append((x - 2, y))
            if x < shape[1] - 2: neighbors.append((x + 2, y))
            if y > 1: neighbors.append((x, y - 2))
            if y < shape[0] - 2: neighbors.append((x, y + 2))
            
            if neighbors:
                x_, y_ = neighbors[np.random.randint(0, len(neighbors))]

                if maze[y_, x_] == 0:
                    maze[y_, x_] = 1
                    maze[y_ + (y - y_) // 2, x_ + (x - x_) // 2] = 1
                    x, y = x_, y_

    return maze

maze = generate_maze(1708, 960, complexity=0.15, density=0.2)

plt.figure(figsize=(17.08, 9.6))
plt.imshow(maze, cmap='binary', interpolation='nearest')
plt.axis('off')

file_path = "/mnt/data/laberinto.png"
plt.savefig(file_path, bbox_inches='tight', pad_inches=0, dpi=100)
plt.close()

file_path
