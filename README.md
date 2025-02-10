# 🎓 Master's Degree Project - Application of Cycle Search in Graphs for Building Training Flight Routes

## 📌 Overview
This project explores the **application of graph theory** to solve the **cycle search problem** for constructing routes in training flight scenarios. The focus is on identifying cycles in large-scale graphs to optimize flight paths efficiently.

The project leverages **depth-first search (DFS)** as the primary algorithm for cycle detection and uses a **PostgreSQL database** for handling large datasets. The implementation is done in **PHP**.

---

## 🎯 Research Goals
1. **Develop an efficient cycle search algorithm** for large-scale graphs with over 70,000 edges.
2. **Optimize data handling** by utilizing a relational database to manage graph data.
3. **Generate training flight routes** by identifying cycles and representing them as geographical coordinates.

---

## ✨ Key Features
1. **Graph Representation**:
   - The graph is stored in a PostgreSQL database table (`graph`) with the following fields:
     - `id`: Identifier for the edge.
     - `source`: Identifier of the starting vertex.
     - `target`: Identifier of the ending vertex.
     - `distance`: Length of the edge.
     - `color`: Used to mark vertex states during DFS.

2. **Algorithm Implementation**:
   - The project employs **depth-first search (DFS)** for cycle detection.
   - **Vertex colors** are used to track progress:
     - White: Unvisited.
     - Gray: Currently being processed.
     - Black: Fully processed.

3. **Performance Optimization**:
   - The PostgreSQL database accelerates processing by efficiently managing and querying the large graph dataset.
   - Results are exported as a JavaScript file (`circles.js`) for visualization.

4. **Visualization of Cycles**:
   - Cycles are output as geographical coordinates of points, enabling visualization of flight routes.

---

## 🛠️ Implementation Details
- **Language**: PHP 7.4.12
- **Database**: PostgreSQL
- **Algorithm**: Depth-first search (DFS)

### Process:
1. **Input Data**:
   - The graph is stored in a PostgreSQL table with fields for edges, vertices, and distances.
   
2. **Cycle Detection**:
   - DFS is applied to find all cycles in the graph.
   - Cycles are identified when a gray-colored vertex is revisited during the traversal.

3. **Output**:
   - The results are exported as a JavaScript file (`circles.js`), containing:
     - Cycle ID.
     - Order of edges in the cycle.
     - Geographical coordinates of the starting and ending points.

4. **Limitations**:
   - Due to PHP's recursion limits and memory constraints, handling very large datasets required additional optimization.
   - For future iterations, **Python** with built-in graph libraries like **NetworkX** is recommended.

---

## 📝 Example Execution
### Graph Table Structure:
| ID  | Source | Target | Distance | Color |
|-----|--------|--------|----------|-------|
| 1   | A      | B      | 100      |       |
| 2   | B      | C      | 150      |       |
| 3   | C      | A      | 200      |       |

### Sample Output (`circles.js`):
```javascript
{
  "data": [
    {
      "cycle_id": 1,
      "edges": ["A -> B", "B -> C", "C -> A"],
      "coordinates": [
        {"start": "A", "lat": 48.8566, "lon": 2.3522},
        {"end": "B", "lat": 41.9028, "lon": 12.4964},
        ...
      ]
    }
  ]
}
```

## 📌 Key Algorithms Explored
1. Floyd's Tortoise and Hare Algorithm:
   - A memory-efficient algorithm for detecting cycles by moving two pointers at different speeds.
2. Brent's Algorithm:
   - Improves upon Floyd’s algorithm using exponential search for cycle detection.
3. Depth-First Search (DFS):
   - Chosen for this project due to its adaptability for detecting cycles in directed and undirected graphs.

## 🚀 Recommendations for Future Work
1. Transition the implementation to Python for handling larger datasets and utilizing libraries like NetworkX for graph analysis.
2. Extend the project to include visualization tools like Gephi or Leaflet.js for a more interactive presentation of flight routes.
3. Implement parallel processing to speed up cycle detection in graphs with millions of edges.

📌 **Author**: _Olha Tkachiv_  
🎓 **Lviv Polytechnic National University**  
