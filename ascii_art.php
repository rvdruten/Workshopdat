<?php

/**
 * Recursively draws a triangle of a given height.
 *
 * @param int $height The total height of the triangle.
 * @param int $row The current row being drawn.
 * @param string $char The character to use for drawing the triangle.
 */
function drawTriangle($height, $row = 0, $char = '*') {
    // Base case: stop when the current row is equal to the height.
    if ($row >= $height) {
        return;
    }

    // Print spaces for alignment.
    echo str_repeat(' ', $height - $row - 1);

    // Print the characters for the current row.
    echo str_repeat($char, 2 * $row + 1);

    // Move to the next line.
    echo "\n";

    // Recursive call for the next row.
    drawTriangle($height, $row + 1, $char);
}

// Call the function to draw a triangle of height 5.
drawTriangle(5);

?>
