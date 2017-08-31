<?php

/**
 * Created by PhpStorm.
 * User: dodd
 * Date: 2017/8/31
 * Time: 00:57
 */
namespace App\Http\Controllers\Vicky;

use App\Http\Controllers\Controller;
use App\Models\VkStory;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    public function index()
    {

        $result = VkStory::orderBy('datetime', 'desc')->orderBy('id', 'desc')->paginate(Input::get('per_page', 20));

        return $this->respData($result);
    }
}