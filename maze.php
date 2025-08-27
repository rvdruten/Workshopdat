<?php

class MazeGenerator {
    private $width;
    private $height;
    private $complexity;
    private $grid;

    public function __construct($width, $height, $complexity = 0) {
        $this->width = ($width % 2 == 0) ? $width + 1 : $width;
        $this->height = ($height % 2 == 0) ? $height + 1 : $height;
        $this->complexity = $complexity;
        $this->initializeGrid();
        $this->generate();
    }

    private function initializeGrid() {
        $this->grid = [];
        for ($y = 0; $y < $this->height; $y++) {
            $this->grid[$y] = [];
            for ($x = 0; $x < $this->width; $x++) {
                $this->grid[$y][$x] = 1; // 1 for wall
            }
        }
    }

    public function generate() {
        $this->carvePassages(1, 1);
        $this->addComplexity();
    }

    private function carvePassages($cx, $cy) {
        $this->grid[$cy][$cx] = 0; // Carve a passage

        $directions = ['N' => [0, -2], 'S' => [0, 2], 'E' => [2, 0], 'W' => [-2, 0]];
        $dirs = array_keys($directions);
        shuffle($dirs);

        foreach ($dirs as $dir) {
            $d = $directions[$dir];
            $nx = $cx + $d[0];
            $ny = $cy + $d[1];

            if ($nx > 0 && $nx < $this->width - 1 && $ny > 0 && $ny < $this->height - 1 && $this->grid[$ny][$nx] == 1) {
                $this->grid[$cy + $d[1]/2][$cx + $d[0]/2] = 0;
                $this->grid[$ny][$nx] = 0;
                $this->carvePassages($nx, $ny);
            }
        }
    }

    private function addComplexity() {
        $wallsToRemove = $this->complexity;
        for ($i = 0; $i < $wallsToRemove; $i++) {
            $x = rand(1, $this->width - 2);
            $y = rand(1, $this->height - 2);
            if ($this->grid[$y][$x] == 1) {
                $this->grid[$y][$x] = 0;
            }
        }
    }

    public function display() {
        $output = '';
        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x++) {
                $output .= $this->grid[$y][$x] == 1 ? '#' : ' ';
            }
            $output .= "\n";
        }
        echo $output;
    }
}

$maze = new MazeGenerator(20, 10, 10);
$maze->display();

?>
