<?php
class Calculator
{
    /**
     * @assert (0, 0) == 0
     * @assert (0, 26) == 26
     * @assert (26, 0) == 26
     * @assert (26, 26) == 2
     */
    public function add($a, $b)
    {
        return $a + $b;
    }
}
