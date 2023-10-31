<?php
namespace App\Helper;

use Auth;
use App\Permission;
use Illuminate\Support\Facades\DB;
use App\Helper\GlobalHelper;
use DateTime;
use DateInterval;
use DatePeriod;
use App\User;
use App\Notification;
use URL;
use Twilio;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\HeaderFooterSettings;
use App\Category;
use App\SubCategory;
use App\Product;
use App\Color;
use App\Size;
use App\Order;
use App\OrderDetail;
use App\Coupon;
use App\Country;

class GlobalHelper
{
  /**
  * Developed By : Krunal
  * Date         :
  * Description  : Time ago
  */
  public static function humanTiming($time){
    $time = time() - strtotime($time); // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
      31536000 => 'year',
      2592000 => 'month',
      604800 => 'week',
      86400 => 'day',
      3600 => 'hour',
      60 => 'minute',
      1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
      if ($time < $unit) continue;
      $numberOfUnits = floor($time / $unit);
      return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
  }

  /**
  * Developed By : Kaushal Adhiya
  * Date         : 19-11-2019
  * Description  : removeNull
  */
  public static function removeNull($array){
    foreach ($array as $key => $value){
      if(is_array($value)){
        $array[$key] = GlobalHelper::removeNull($value);
      }else{
        if (is_null($value))
        $array[$key] = "";
      }
    }
    return $array;
  }

  public static function removeNullMultiArray($model){
    foreach($model as $rsKey => $rs){
      foreach($rs as $key => $value){
        if(is_null($value)){
          $model[$rsKey][$key] = "";
        }
      }
    }
    return $model;
  }

  /**
  * Developed By : Ajarudin Gugna
  * Date         :
  * Description  : Get formated date
  */
  public static function getFormattedDate($date)
  {
    if(!empty($date)){
      $date = date_create($date);
      return date_format($date, "d-M-Y");
    }
    else {
      return "";
    }
  }

  /**
  * Developed By : Ajarudin Gugna
  * Date         :
  * Description  : Get user by id
  */
  public static function getUserById($id)
  {
    $user = User::where('id','=',$id)
    ->first();
    return $user;
  }


  /**
  * Developed By : Krunal
  * Date         : 25-8-17
  * Description  : generateRandomNumber
  */
  public static function generateRandomNumber($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  /**
  * Developed By : Jignasa
  * Date         :
  * Description  : sentence teaser
  * this function will cut the string by how many words you want
  */
  public static function word_teaser($string, $count){
    $original_string = $string;
    $words = explode(' ', $original_string);

    if (count($words) > $count){
      $words = array_slice($words, 0, $count);
      $string = implode(' ', $words);
    }

    return $string.'...';
  }

  /**
  * Developed By : Jignasa
  * Date         :
  * Description  : Get user profile image by id
  */
  public static function getUserImageById($id)
  {
    $user = User::select('profile_image')->where('id','=',$id)->first();
    if($user && $user->profile_image){
      return URL::asset('/resources/uploads/profile').'/'.$user->profile_image;
    }else{
      return URL::asset('/resources/uploads/profile/default.jpg');
    }
  }

  /**
  * Description  : Use to convert large positive numbers in to short form like 1K+, 100K+, 199K+, 1M+, 10M+, 1B+ etc
  */
  public static function number_format_short( $n ) {

    if ($n >= 0 && $n < 1000) {
      // 1 - 999
      $n_format = floor($n);
      $suffix = '';
    } else if ($n >= 1000 && $n < 10000) {
      // 1k-999k
      $n_format = floor($n);
      $suffix = '';
    }else if ($n >= 10000 && $n < 1000000) {
      // 1k-999k
      $n_format = floor($n / 1000);
      $suffix = 'K+';
    } else if ($n >= 1000000 && $n < 1000000000) {
      // 1m-999m
      $n_format = floor($n / 1000000);
      $suffix = 'M+';
    } else if ($n >= 1000000000 && $n < 1000000000000) {
      // 1b-999b
      $n_format = floor($n / 1000000000);
      $suffix = 'B+';
    } else if ($n >= 1000000000000) {
      // 1t+
      $n_format = floor($n / 1000000000000);
      $suffix = 'T+';
    }

    return !empty($n_format . $suffix) ? $n_format . $suffix : 0;
  }

  /**
   * Developed By :
  * Date         :
  * Description  : Send FCM For android
  */
  public static function sendFCM($title, $message, $target,$notification_type,$detail){
    //$baseurl="http://".url();
    //FCM api URL
    $url = 'https://fcm.googleapis.com/fcm/send';
    //api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
    $server_key = env('FCM_SERVER_KEY');

    $fields = array();
    // $fields['notification'] = array();
    // $fields['notification']['body'] = $message;
    // $fields['notification']['title'] = $title;
    // $fields['notification']['click_action'] = '.MainActivity';
    // $fields['notification']['sound'] = 'default';

    $fields['content_available'] = true;
    $fields['data'] = array();
    $fields['data']['body'] = $message;
    $fields['data']['title'] = $title;
    $fields['data']['click_action'] = '.MainActivity';
    $fields['data']['sound'] ='default';
    $fields['data']['notification_type'] = $notification_type;
    $fields['data']['detail'] = $detail;
    // if(is_array($target)){
    //   $fields['registration_ids'] = $target;
    // }else{
    $fields['to'] = $target;
    // }
    $fields['priority'] = "high";

    $headers = array(
    'Content-Type:application/json',
    'Authorization:key='.$server_key
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);

    if ($result === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);

    return $result;
  }

  /**
   * Developed By :
  * Date         :
  * Description  : Send GCM for iphone
  */
  public static function sendGCM($title,$message,$deviceToken,$app_type,$notification_type,$detail){

    // Put your device token here (without spaces):
    // $title = 'Hello';
    // $app_type = 'debug';
    // $deviceToken = '243540a20a1d934f7cd0fac714a45f9173eca6dfda978d116d14a7250d04f004';

    // Put your private key's passphrase here:
    $passphrase = '';

    // Put your alert message here:
    // $message = 'My cQpon push notification!';

    // $ctx = stream_context_create();
    // stream_context_set_option($ctx, 'ssl', 'local_cert', 'tys_debug_Push_certificate.pem');
    // stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

    // Open a connection to the APNS server
    if($app_type == 'debug'){
      $ctx = stream_context_create();
      stream_context_set_option($ctx, 'ssl', 'local_cert', 'NextTec_PUSH.pem');
      stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
      $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

    }else{
      $ctx = stream_context_create();
      stream_context_set_option($ctx, 'ssl', 'local_cert', 'NextTec_PUSH.pem');
      stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
      $fp = stream_socket_client(
        'ssl://gateway.push.apple.com:2195', $err,
        $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

      }

      // if (!$fp)
      // exit("Failed to connect: $err $errstr" . PHP_EOL);
      //
      // echo 'Connected to APNS' . PHP_EOL;

      // Create the payload body
      $body['aps'] = array(
        'alert' =>array(
          'title' => $title,
          'body' => $message,
          'notification_type' => $notification_type,
          'detail' => $detail,
        ),
        'mutable-content'=> 1,
        'sound' => 'default',
        'content-available' =>1
      );

      //$body['image'] = $image;

      // Encode the payload as JSON
      $payload = json_encode($body);
      // Build the binary notification
      if(strlen($deviceToken) == '64'){
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
      }else{
          $msg = chr(0) . pack('H*', str_replace(' ', '', sprintf('%u', CRC32($deviceToken)))) . pack('n', strlen($payload)) . $payload;
      }
      //$msg = chr(0) . pack('H*', str_replace(' ', '', sprintf('%u', CRC32($deviceToken)))) . pack('n', strlen($payload)) . $payload;

      // Send it to the server
      $result = fwrite($fp, $msg, strlen($msg));
      // if (!$result)
      // echo 'Message not delivered' . PHP_EOL;
      // else
      // echo 'Message successfully delivered' . PHP_EOL;

      // Close the connection to the server
      fclose($fp);
  }

  public static function getPermissionByCategory($category){
      $getPermissions = Permission::where("category",$category)->where('status','1')->get();
      return $getPermissions;
  }

 // Add data in fire base
  public static function firebaseSaveNotification($title, $message,$reciver_id,$sender_id) {
    $serviceAccount = ServiceAccount::fromJsonFile(env('FIREBASE_JSON_FILE_LOCATION'));
    $firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri(env('FIREBASE_DATABASEURL'))
    ->create();

    $database = $firebase->getDatabase();

    $newPost = $database
    ->getReference('ewt')
    ->push([
      'title' => (string) $title,
      'message' => $message,
      'reciver_id' => (string) $reciver_id,
      'sender_id' => (string) $sender_id
    ]);
    // dd($newPost->getvalue());
    return $newPost->getvalue();
  }

  public static function header_list(){
    $header = HeaderFooterSettings::first();
    // dd($header);
    return $header;
  }

  public static function category($category){
    $id = explode(",",$category);
    $cat = Category::wherein("category_id",$id)->pluck('name')->toArray();
    $name = implode(" , ",$cat);
    return $name;
}
public static function subCategory($sub_category){
  $id = explode(",",$sub_category);
  $cat = SubCategory::wherein("sub_category_id",$id)->pluck('name')->toArray();
  $sub_category_name = implode(" , ",$cat);
  return $sub_category_name;
}
public static function product($product){
  $id = explode(",",$product);
  $cat = Product::where("product_id",$id)->pluck('product_name')->toArray();
  $product_name = implode(" , ",$cat);
  return $product_name;
}
public static function color($color){
  $id = explode(",",$color);
  $cat = Color::wherein("color_id",$id)->pluck('color_name')->toArray();
  $color_name = implode(" , ",$cat);
  return $color_name;
}
public static function size($size){
  $id = explode(",",$size);
  $cat = Size::wherein("size_id",$id)->pluck('size_name')->toArray();
  $size_name = implode(" , ",$cat);
  return $size_name;
}

public static function country($country){
  $id = $country;
  $cat = Country::where("country_id",$id)->pluck('name')->toArray();
  $name = $cat;
  return $name;
}

public static function changeProductPriority($productid,$priority)
  {
    if($priority) {
      $product = Product::where('product_id',$productid)->first();
      if($product->product_priority > $priority) {
        $checkPriority = $priority;
        $otherproducts = Product::where('product_id','!=',$productid)->where('product_priority','>=',$checkPriority)->orderBy('product_priority','asc')->get();
        if($otherproducts) {
          $i = $checkPriority+1;
          foreach($otherproducts as $otherproduct) {
            $otherproduct->product_priority = $i;
            $otherproduct->save();
            $i++;
          }
        }
      } else {
        $checkPriority = $product->product_priority;
        $checkhighPriority = $priority;
        $otherproducts = Product::where('product_id','!=',$productid)
          ->where('product_priority','>=',$checkPriority)
          ->where('product_priority','<=',$checkhighPriority)
          ->orderBy('product_priority','asc')->get();
        if($otherproducts) {
          foreach($otherproducts as $otherproduct) {
            $otherproduct->product_priority = $otherproduct->product_priority - 1;
            $otherproduct->save();
          }
        }
        $otherproducts = Product::where('product_id','!=',$productid)->where('product_priority','>',$checkhighPriority)->orderBy('product_priority','asc')->get();
        if($otherproducts) {
          $i = $checkhighPriority+1;
          foreach($otherproducts as $otherproduct) {
            $otherproduct->product_priority = $i;
            $otherproduct->save();
            $i++;
          }
        }
      }
      $product->product_priority = $priority;
      $product->save();
    } else {
      $max_priority = Product::max('product_priority');
      $product = Product::where('product_id',$productid)->update([
        "product_priority" => $max_priority+1
      ]);
    }
  }

  public static function manageOrderQuantity($order_id)
  {
    $order = Order::where('order_id',$order_id)->first();
    $orderDetails = OrderDetail::where('order_id', $order->order_id)->get();
    $quantity = 0;
    $total = 0;
    $sub_total = 0;
    $discount_amount = 0;
    foreach($orderDetails as $orderDetail)
    {
      $product = Product::where('product_id', $orderDetail['product_id'])->first();
      if(Auth::user()){
          if(Auth::user()->role_id==2){
              if($product['offer_customer_price'])
              {
                  $orderDetail->price = $product['offer_customer_price'];
              }else{
                  $orderDetail->price = $product['customer_product_price'];
              }

          }elseif(Auth::user()->role_id==3){
              if($product['offer_reseller_price']){
                  $orderDetail->price = $product['offer_reseller_price'];
              }elseif($product['reseller_product_price']){
                  $orderDetail->price = $product['reseller_product_price'];
              }else{
                  $orderDetail->price = $product['customer_product_price'];
              }
          } else {
              $orderDetail->price = $product['customer_product_price'];
          }
      }else{
          $orderDetail->price = $product['customer_product_price'];
      }
      $orderDetail->save();
      $orderDetailTotal = $orderDetail->quantity * $orderDetail->price;
      $sub_total = $sub_total + $orderDetailTotal;
      $total = $total + $orderDetailTotal;
      $quantity = $quantity + $orderDetail->quantity;
      $orderDetail->total = $orderDetailTotal;
      $orderDetail->save();
    }
    if($order['coupon_code']){
      $coupon=Coupon::where('code', 'LIKE', '%' . $order['coupon_code'] . '%')->where('limit','>=',0)->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->first();
      if($coupon['type']=='percentage')
      {
          $a=($total)*($coupon['value']/100);
          $discount_amount = $a;
          $b=$total-$a;
          $total=$b;
      }else{
        $total=$total-$coupon['value'];
        $discount_amount =$coupon['value'];
      }
    }
    if($total == 0) {
      $order->delete();
    } else {
      $order->final_quantity = $quantity;
      $order->sub_total = $sub_total;
      $order->discount_amount = $discount_amount;
      $order->total = $total;
      $order->save();
    }
    return 1;
  }
}
