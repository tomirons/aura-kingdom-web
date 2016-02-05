<?php

namespace App\Http\Controllers\Front;

use App\ShopItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    /**
     * Assign middleware
     */
    public function __construct()
    {
        $this->middleware( 'auth' );

        $this->middleware( 'selected.character', ['only' => ['postPurchase', 'postGift'] ] );

        $this->middleware( 'server.online', ['only' => ['postPurchase', 'postGift'] ] );
    }

    public function getIndex()
    {
        pagetitle( [ trans( 'main.apps.shop' ), settings( 'server_name' ) ] );
        $items = ShopItem::paginate( settings( 'shop_items_per_page' ) );
        return view( 'front.shop.index', compact( 'items' ) );
    }
}
