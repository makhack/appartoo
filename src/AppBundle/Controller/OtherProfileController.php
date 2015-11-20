<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OtherProfileController extends Controller
{
    public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->find($request->get('id'));
        
        return $this->render('AppBundle:OtherProfile:show.html.twig',array('user'=>$user));
    }
    
}
