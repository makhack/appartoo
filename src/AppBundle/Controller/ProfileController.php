<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class ProfileController extends Controller
{

    public function showAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        var_dump($user);
        return $this->render('AppBundle:Profile:show.html.twig',array('user'=>$user));
    }
    
    public function editAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        return $this->render('AppBundle:Profile:edit.html.twig',array('user'=>$user));
    }
    
    public function deleteAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        return $this->render('AppBundle:Profile:delete.html.twig',array('user'=>$user));
    }
    
    public function addAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        return $this->render('AppBundle:Profile:add.html.twig',array('user'=>$user));
    }

}
