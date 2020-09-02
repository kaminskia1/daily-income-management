<?php

class View
{
    public static function run(): array
    {
        // Import twig instance
        global $twig;

        // Grab data
        $data = (array)json_decode( file_get_contents('data/data.json') );

        // Calculate and append weekly data
        $tmp = (object)[
            'date' => "<b>Total</b>:",
            'profit' => 0,
            'loss' => 0,
            'dd' => 0
        ];
        foreach ( $data as $r )
        {
            $tmp->profit += $r->profit;
            $tmp->loss += $r->loss;
            $tmp->dd += $r->dd;
        }
        $tmp->net = $tmp->profit - $tmp->loss - $tmp->dd;
        array_push($data, $tmp);

        // Return loaded template
        return [ 'title' => 'View', 'body' => $twig->load('view.twig')->render( [ 'data' => $data ] ) ];
    }
}