<?php

if ( ! function_exists( 'gold_format' ) )
{
    function gold_format( $total )
    {
        $gold = floor( $total );
        $silver = ( is_float( $total ) ) ? ltrim( explode( '.', $total )[1], '0' ) : 0;

        return ( $gold > 0 || $silver > 0 ) ? trans( 'ranking.gold', [ 'gold' => $gold, 'silver' => $silver ] ) : '-';
    }
}

if ( ! function_exists( 'is_active' ) )
{
    /**
     * Set the active class to the current opened menu
     *
     * @param  string|array $route
     * @param  string $className
     * @return string
     */
    function is_active( $route, $className = 'active' )
    {
        if ( is_array( $route ) ) {
            return in_array(Route::currentRouteName(), $route ) ? $className : '';
        }
        if ( Route::currentRouteName() == $route ) {
            return $className;
        }
        if ( strpos( URL::current(), $route ) ) return $className;
    }
}

if ( ! function_exists( 'is_done' ) )
{
    /**
     * Check weather or not the step is complete
     *
     * @param $step
     * @return null|string
     */
    function is_done($step )
    {
        $steps = steps();
        $step = array_search( $step, $steps );
        $current_step = array_search( Route::currentRouteName(), $steps );
        return ( $current_step > $step ) ? 'done' : NULL;
    }
}

if ( ! function_exists( 'steps' ) )
{
    /**
     * Get all the installer steps
     *
     * @return array
     */
    function steps()
    {
        $steps = [];
        foreach ( Route::getRoutes() as $route )
        {
            $route_name = $route->getName();
            if ( str_contains( $route_name, 'admin.installer' ) )
            {
                $steps[] = $route_name;
            }
        }
        return $steps;
    }
}