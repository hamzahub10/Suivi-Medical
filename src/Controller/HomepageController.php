<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/homepage', name: 'app_homepage')]
    public function index(): Response
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('homepage/about.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/blog_details', name: 'app_blog_details')]
    public function blog_details(): Response
    {
        return $this->render('homepage/blog_details.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/blog', name: 'app_blog')]
    public function blog(): Response
    {
        return $this->render('homepage/blog.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('homepage/contact.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/department', name: 'app_department')]
    public function department(): Response
    {
        return $this->render('homepage/department.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/doctor', name: 'app_doctor')]
    public function doctor(): Response
    {
        return $this->render('homepage/doctor.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/main', name: 'app_main')]
    public function main(): Response
    {
        return $this->render('homepage/main.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
}
