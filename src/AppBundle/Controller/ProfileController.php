<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{

    public function allAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $allUser = $em->getRepository('UserBundle:User')->findAll();
        
        return $this->render('AppBundle:Profile:all.html.twig',array('allUser'=>$allUser,'user'=>$user));
    }
    
    public function showAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        return $this->render('AppBundle:Profile:show.html.twig',array('user'=>$user));
    }
    
    public function editAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createForm('userbundle_user', $user);
        
        if($request->getMethod() == 'POST')
        {
            $form->submit($request);

            if($form->isValid())
            {
                $em->persist($user);
                $em->flush();
            }
        }

        return $this->render('AppBundle:Profile:edit.html.twig',array('form'=>$form->createView()));
    }
    
        /**
     * 
     * 
     * Permet d'ajouter un ami 
     */
    public function deleteAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $userToAdd =$em->getRepository('UserBundle:User')->find($request->get('id'));
        
        $flag = false;
        
        foreach($user->getMyFriends() as $u)
        {
            
            if($u->getEmail() == $userToAdd->getEmail())
            {

                $flag = true;
            }
        }
        
        if($flag !== false){
            $user->removeMyFriend($userToAdd);
            $em->persist($user);
            $em->flush();
        }
        
        return $this->redirectToRoute('app_bundle_profile_show_friends');
    }
    
    /**
     * 
     * 
     * Permet d'ajouter un ami 
     */
    public function addAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $userToAdd =$em->getRepository('UserBundle:User')->find($request->get('id'));
        
        $flag = false;
        
        foreach($user->getMyFriends() as $u)
        {
            if($u == $userToAdd)
            {
                $flag = true;
            }
        }
        
        if($flag !== true){
            $user->addMyFriend($userToAdd);
            $em->persist($user);
            $em->flush();
        }
        
        

        
        return $this->redirectToRoute('app_bundle_profile_all');
    }
    
    public function showFriendsAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        
        return $this->render('AppBundle:Profile:show_friends.html.twig',array('userFriends'=>$user->getMyFriends()));
    }
    
    public function showFriendAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        return $this->render('AppBundle:Profile:show_friend.html.twig',array('user'=>$user));
    }
}
