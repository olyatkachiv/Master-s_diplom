<?php


class Search
{

    private $pdo, $recursionStack=array(array()), $counter = 0, $file, $index = 0;

/*dfs(v, v_start):
    if (visited[v]):
        if (v == v_start):
            вывести цикл
        return

   visited[v] = 1
   for neighbor in adjlist[v]:
       dfs(neighbor, v_start )
   visited[v] = 0*/
    public function __construct()
    {
        $host = 'localhost';
        $db = 'm_app';
        $username = 'postgres';
        $password = 'postgres';
        $dsn = sprintf("pgsql:host=%s;port=5432;dbname=%s;user=%s;password=%s", $host, $db, $username, $password);
        $this->pdo=new PDO($dsn);
        $this->file=fopen("circles.js","w+");
        ini_set('memory_limit', '-1');
    }

    public function __destruct()
    {
        fclose($this->file);
    }

    public function getVertex($index): array
    {
        $query = "SELECT source,target,color FROM public.graph WHERE source=$index";
        $coordinatesStatement = $this->pdo->prepare($query);
        $coordinatesStatement->execute();
        $buff = $coordinatesStatement->fetchAll(PDO::FETCH_ASSOC);
        $buff = array_map('unserialize',array_unique(array_map('serialize', $buff))); //remove all repeating arcs
        if ($buff) {
        return $buff;
        } else
            return array(array('color'=>'G'));
    }

    public function setVertex($color, $index){
        $query = "UPDATE public.graph SET color = ? WHERE source = $index";
        $coordinatesStatement = $this->pdo->prepare($query);
        $coordinatesStatement->execute([$color]);
    }

    public function findCycles($vertex, $vertex_start)
    {
        if ($this->counter <= 40) {
            if (current($this->getVertex($vertex))['color'] === 'G') {
                if ($vertex === $vertex_start) {
                    //if (isset($this->recursionStack[1])) {
                        foreach ($this->recursionStack as $arc) {
                            fwrite($this->file, $arc[0] . '->' . $arc[1].' ');
                            echo $arc[0] .'->' . $arc[1].' ';
                        }
                        fwrite($this->file,PHP_EOL);
                        echo '<br>';
                    //}
//                    array_splice($this->recursionStack, -1);
                }
//                array_splice($this->recursionStack, -1);
                return false;
            }

            $this->setVertex('G', $vertex);
            foreach ($this->getVertex($vertex) as $arc) {
                $this->recursionStack[$this->index] = [$arc['source'], $arc['target']];
                $this->counter++;
                $this->index++;
                if (count($this->recursionStack) < 40) {
                $this->findCycles($arc['target'], $vertex_start);
                }
                else {
//                    array_splice($this->recursionStack,-1);
                    unset($this->recursionStack);
                    return false;
                }
            }
            $this->setVertex('B', $vertex);
        } else  {
        $this->counter=0;
        return false;
        }
    }


    public function unsetStack() {

        unset($this->recursionStack);
        $this->counter=0;
        $query = "UPDATE public.graph SET color = ?";
        $coordinatesStatement = $this->pdo->prepare($query);
        $coordinatesStatement->execute(['W']);
        echo '<br>';
        echo '<br>';

    }
}