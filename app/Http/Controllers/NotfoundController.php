<?php 

namespace App\Http\Controllers;
use App\Http\Response;
class NotfoundController 
{
    public function index()
    {
          return new Response('404');
    }
}




 ?>