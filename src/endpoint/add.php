<?php

class Add
{
    public static function run(): array
    {
        // Import twig instance
        global $twig;
        global $password;

        // Check if form submit
        if ( Request::i()->is( "POST" ) && $password == Request::i()->password )
        {
            if ( !is_null( Request::i()->p ) && !is_null( Request::i()->l ) && !is_null( Request::i()->d ) ) {
                // Get file contents
                $data = (array)json_decode(file_get_contents('data/data.json'));

                // Push new data
                array_push($data, [
                    'date' => date('m/d/y'),
                    'profit' => (int)Request::i()->p,
                    'loss' => (int)Request::i()->l,
                    'dd' => (int)Request::i()->d,
                    'net' => ((int)Request::i()->p - (int)Request::i()->l - (int)Request::i()->d)
                ]);

                // Write new data
                file_put_contents('data/data.json', json_encode((object)$data, JSON_PRETTY_PRINT));

                // Redirect to main view
                header('Location: ' . $_SERVER['PHP_SELF']);

                // Fallback success message if header error
                return ['title' => 'Add', 'body' => 'Added Successfully! Reloading will cause this page to resubmit.'];
            }
        }

        // Return add template
        return [ 'title' => 'Add', 'body' => $twig->load( 'add.twig' )->render() ];
    }
}