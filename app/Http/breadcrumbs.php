<?php
/* Home */
Breadcrumbs::register( 'home', function( $breadcrumbs )
{
    $breadcrumbs->push( trans( 'main.home' ), url( '/' ) );
});

/* Account Settings */
Breadcrumbs::register( 'account.settings', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'home' );
    $breadcrumbs->push( trans( 'main.account' ) );
    $breadcrumbs->push( trans( 'main.settings' ) );
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

/* Ranking */
Breadcrumbs::register( 'ranking.index', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'home' );
    $breadcrumbs->push( trans( 'main.apps.ranking' ) );
});

/*
|--------------------------------------------------------------------------
| Admin Breadcrumbs
|--------------------------------------------------------------------------
*/
Breadcrumbs::register( 'admin.index', function( $breadcrumbs )
{
    $breadcrumbs->push( trans( 'main.dashboard' ), route( 'admin.index' ) );
});

/* System */
Breadcrumbs::register( 'admin.system.settings', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'admin.index' );
    $breadcrumbs->push( trans( 'main.settings' ) );
});

Breadcrumbs::register( 'admin.system.apps', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'admin.index' );
    $breadcrumbs->push( trans( 'system.apps' ) );
});

/* Members */
Breadcrumbs::register( 'admin.members.manage', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'admin.index' );
    $breadcrumbs->push( trans( 'main.apps.members' ) );
    $breadcrumbs->push( trans( 'members.manage' ) );
});

Breadcrumbs::register( 'admin.members.balance', function( $breadcrumbs, \App\User $user )
{
    $breadcrumbs->parent( 'admin.index' );
    $breadcrumbs->push( trans( 'main.apps.members' ) );
    $breadcrumbs->push( trans( 'members.balance', ['member' =>  $user->username] ) );
});

Breadcrumbs::register( 'admin.members.permissions', function( $breadcrumbs, \App\User $user )
{
    $breadcrumbs->parent( 'admin.index' );
    $breadcrumbs->push( trans( 'main.apps.members' ) );
    $breadcrumbs->push( trans( 'members.permissions', ['member' =>  $user->username] ) );
});

/* News */
Breadcrumbs::register( 'admin.news', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'admin.index' );
    $breadcrumbs->push( trans( 'main.apps.news' ) );
});

Breadcrumbs::register( 'admin.news.index', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'admin.news' );
    $breadcrumbs->push( trans( 'news.index' ) );
});

Breadcrumbs::register( 'admin.news.create', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'admin.news' );
    $breadcrumbs->push( trans( 'news.create' ) );
});

Breadcrumbs::register( 'admin.news.edit', function( $breadcrumbs, \App\Article $article )
{
    $breadcrumbs->parent( 'admin.news' );
    $breadcrumbs->push( trans( 'news.edit', ['title' => $article->title] ) );
});

Breadcrumbs::register( 'admin.news.settings', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'admin.news' );
    $breadcrumbs->push( trans( 'main.settings' ) );
});

/* Donate */
Breadcrumbs::register( 'admin.donate.settings', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'admin.index' );
    $breadcrumbs->push( trans( 'main.apps.donate' ) );
    $breadcrumbs->push( trans( 'main.settings' ) );
});

/* Vote */
Breadcrumbs::register( 'admin.vote', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'admin.index' );
    $breadcrumbs->push( trans( 'main.apps.vote' ) );
});

Breadcrumbs::register( 'admin.vote.index', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'admin.vote' );
    $breadcrumbs->push( trans( 'vote.index' ) );
});

Breadcrumbs::register( 'admin.vote.create', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'admin.vote' );
    $breadcrumbs->push( trans( 'vote.create' ) );
});

Breadcrumbs::register( 'admin.vote.edit', function( $breadcrumbs, \App\VoteSite $site )
{
    $breadcrumbs->parent( 'admin.vote' );
    $breadcrumbs->push( trans( 'vote.edit', ['name' => $site->name] ) );
});

/* Ranking */
Breadcrumbs::register( 'admin.ranking.settings', function( $breadcrumbs )
{
    $breadcrumbs->parent( 'admin.index' );
    $breadcrumbs->push( trans( 'main.apps.ranking' ) );
    $breadcrumbs->push( trans( 'main.settings' ) );
});