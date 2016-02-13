<?php
/* Home */
Breadcrumbs::register( 'home', function( $breadcrumbs )
{
    $breadcrumbs->push( trans( 'main.home' ), url( '/' ) );
});

/* News */
Breadcrumbs::register( 'news.index', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'home' );
    $breadcrumbs->push( trans( 'main.apps.news' ) );
});

/* Donate */
Breadcrumbs::register( 'donate.index', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'home' );
    $breadcrumbs->push( trans( 'main.apps.donate' ) );
});

/* Vote */
Breadcrumbs::register( 'vote.index', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'home' );
    $breadcrumbs->push( trans( 'main.apps.vote' ) );
});

Breadcrumbs::register( 'vote.success', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'vote.index' );
    $breadcrumbs->push( trans( 'vote.success.title' ) );
});