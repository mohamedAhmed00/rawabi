<?php

use \Illuminate\Support\Facades\Storage;

if (!function_exists('uploadFile')) {

    /**
     * @param $destination
     * @param $file
     * @param null $item
     * @return string
     * @author Mohamed Ahmed
     */
    function uploadFile($destination, $file)
    {
        if (!empty($file)) {
            $file_name = md5(time()) . '.' . $file->getClientOriginalExtension();
            return Storage::disk('public')->putFileAs($destination, $file, $file_name);
        }
    }
}

if (!function_exists('parse_location')) {

    /**
     * @param $destination
     * @param $image
     * @param null $item
     * @return string
     * @author Mohamed Ahmed
     */
    function parse_location($address)
    {
        $map = explode(',', $address);
        if (!empty($map[0]) and !empty($map[1])) {
            $location = array(
                'Lat' => $map[0],
                'Lng' => $map[1],
            );
            return $location;
        }
    }

    /**
     * @param $id
     * @author Mohamed Ahmed
     */
    function get_invoice($id,$checkout){

        $mpdf = new \Mpdf\Mpdf(
            [
                'mode' => 'utf-8',
                'autoArabic' => true,
                'forcePortraitHeaders' => false,
                'format' =>'A4-P',
                'margin_top' => 0,
                'margin_left' => 0,
                'margin_right' => 0,
                'margin_bottom' => 0,
                'default_font' => '',
            ]
        );
        $htmlContent = view('admin.pages.checkouts.invoice-pdf',compact('checkout'))->render();
        $mpdf->imageVars['logo'] = file_get_contents(public_path('assets/admin/images/logo.png'));
        $mpdf->showImageErrors = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->useAdobeCJK = true;
        $mpdf->WriteHTML($htmlContent);
        $mpdf->Output(storage_path('app/public/uploads/pdf/' . $id . '.pdf'));
    }
}

if (!function_exists('getTotalCart')) {

    /**
     * @param $cart
     * @return string
     * @author Mohamed Ahmed
     */
    function getTotalCart($cart)
    {
        $price = 0;
        foreach ($cart as $item){
            $content = json_decode($item->content);
            $price += $content->price * $content->qty;
        }
        return $price;
    }
}

if (!function_exists('productsCartParserApi')) {

    /**
     * @param $products
     * @return string
     * @author Mohamed Ahmed
     */
    function productsCartParserApi($products)
    {
        $items = array();
        foreach ($products as $product){
            $content =  json_decode($product->content);
            $content->options = (array)$content->options;
            $content->subTotal = $product->price * $product->qty;
            $items[] = $content;
        }
        return $items;
    }
}

if (!function_exists('parseSettings')) {

    /**
     * @param $settings
     * @return array
     * @author Mohamed Ahmed
     */
    function parseSettings($settings)
    {
        $items = array();
        foreach ($settings as $setting){
            $items[$setting['key']] = $setting['value'];
        }
        return $items;
    }
}

if (!function_exists('getSiteSettings')) {

    /**
     * @return array
     * @author Mohamed Ahmed
     */
    function getSiteSettings()
    {
        return parseSettings(app(\App\Domain\Setting\Repositories\Abstraction\IRepositorySetting::class)->allby([])->toArray());
    }
}





