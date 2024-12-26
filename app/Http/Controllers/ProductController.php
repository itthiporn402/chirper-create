<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ProductController extends Controller
{
    // ข้อมูลสินค้า
    private $products = [
        ['id' => 1, 'name' => 'Laptop', 'description' => 'High-performance laptop', 'price' => 28900,'image' => '/images/laptop.png'],
        ['id' => 2, 'name' => 'Smartphone', 'description' => 'Latest smartphone with great features', 'price' => 29000, 'image' => '/images/Smartphone.png'],
        ['id' => 3, 'name' => 'Tablet', 'description' => 'Portable tablet for everyday use', 'price' => 8900, 'image' => 'https://aws-obg-image-lb-3.tcl.com/content/dam/brandsite/region/global/products/tablets/tcl-nxtpaper-14/ksp-pc/11-2.jpg?t=1721270288871&w=600&webp=true&dpr=2.625&rendition=1068'],
        ['id' => 4, 'name' => 'Headphones', 'description' => 'Noise-cancelling headphones', 'price' => 590, 'image' => 'https://i5.walmartimages.com/seo/TCJJ-Kids-Headphones-Cat-Ear-Wireless-LED-Light-Bluetooth-Purple-Headphones-Toddler-Boy-Girl-Teen-Children-With-Microphone-Phone-Tablet-Laptop-School_d5ad1c6a-34d3-4056-903d-97962d216648.1aff4fbce6e467724d2a187fee6cc2e4.jpeg?odnHeight=264&odnWidth=264&odnBg=FFFFFF'],
        ['id' => 5, 'name' => 'Smartwatch', 'description' => 'Stylish smartwatch with fitness tracking', 'price' => 9500, 'image' => 'https://i.ebayimg.com/images/g/Mj8AAOSw-vhnUx7r/s-l1200.jpg'],
        ['id' => 6, 'name' => 'Camera', 'description' => 'High-quality DSLR camera', 'price' => 20000, 'image' => 'https://th-test-11.slatic.net/p/c108cb9db6d9d1a17e9b6c6c7cb77bb4.jpg'],
        ['id' => 7, 'name' => 'Speaker', 'description' => 'Portable Bluetooth speaker', 'price' => 10000, 'image' => 'https://media.education.studio7thailand.com/56044/JBL-Speaker-Party-Box-Encore-2-Microphone-01.jpg'],
        ['id' => 8, 'name' => 'Keyboard', 'description' => 'Mechanical keyboard for gaming', 'price' => 1500, 'image' => 'https://media.education.studio7thailand.com/45972/196188487143-01-square_medium.jpg'],
        ['id' => 9, 'name' => 'Monitor', 'description' => 'Ultra-wide curved monitor', 'price' => 15000, 'image' => 'https://www.lg.com/content/dam/channel/wcms/th/image-update/monitor/2024/45gs95qe-b-atm/gallery/ultragear-45gs95qe-basic-large.jpg'],
        ['id' => 10, 'name' => 'Gaming Chair', 'description' => 'Ergonomic chair for gamers', 'price' => 50000, 'image' => 'https://s.alicdn.com/@sc04/kf/H58e042ef7fae42af8bf3f8360dd34dcbd.jpg_720x720q50.jpg'],
    ];


    // แสดงรายการสินค้าทั้งหมด 
    public function index()
    {
        return Inertia::render('Products/Index', ['products' => $this->products]);
    }

    // แสดงรายละเอียดสินค้าตาม ID
    public function show($id)
    {
        $product = collect($this->products)->firstWhere('id', $id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        return Inertia::render('Products/Show', ['product' => $product]);
    }
}
