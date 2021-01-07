<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IngenieriaController extends Controller
{
    public function index(){
        return view('ingenieria.index');
    }
    public function formulario(Request $request)
    {
        $form = $request->form;
        $formulario = "";
        if($form==1){
            $formulario = "<iframe width='100%' height='100%' src= 'https://forms.office.com/Pages/ResponsePage.aspx?id=-5WHxQI14EyokZ090rbkj1FreuApLY1IrTetfv8uRHJURVRLQVk5U1YyU1lZQzFBUVA0VVBTSUlNOCQlQCN0PWcu&embed=true' frameborder= '0' marginwidth='0' marginheight='0' style='border: none; max-width:100%; max-height:100vh' allowfullscreen webkitallowfullscreen mozallowfullscreen msallowfullscreen></iframe>";
        }else if($form==2){
            $formulario = '<iframe width="100%" height= "100%" src= "https://forms.office.com/Pages/ResponsePage.aspx?id=-5WHxQI14EyokZ090rbkj1FreuApLY1IrTetfv8uRHJUNDQ0UzlWMjQ3U1pQUTRPVkJTTVlTT0pERSQlQCN0PWcu&embed=true" frameborder= "0" marginwidth= "0" marginheight= "0" style= "border: none; max-width:100%; max-height:100vh" allowfullscreen webkitallowfullscreen mozallowfullscreen msallowfullscreen> </iframe>';
        }else if($form==3){
            $formulario = '<iframe width="100%" height= "100%" src= "https://forms.office.com/Pages/ResponsePage.aspx?id=-5WHxQI14EyokZ090rbkj1FreuApLY1IrTetfv8uRHJURUdRU0EyNEtBNEhXVU43WDBPSjE5RVpITiQlQCN0PWcu&embed=true" frameborder= "0" marginwidth= "0" marginheight= "0" style= "border: none; max-width:100%; max-height:100vh" allowfullscreen webkitallowfullscreen mozallowfullscreen msallowfullscreen> </iframe>';
        }else if($form==4){
            $formulario = '<iframe width="100%" height= "100%" src= "https://forms.office.com/Pages/ResponsePage.aspx?id=-5WHxQI14EyokZ090rbkj1FreuApLY1IrTetfv8uRHJUMERYTFQwTVhUMDhFOUJZNE1DQjlHVEIwUCQlQCN0PWcu&embed=true" frameborder= "0" marginwidth= "0" marginheight= "0" style= "border: none; max-width:100%; max-height:100vh" allowfullscreen webkitallowfullscreen mozallowfullscreen msallowfullscreen> </iframe>';
        } 
        return view('ingenieria.formulario',compact('formulario'));
    }
}
