<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use App\Entity\Room;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\RoomRepository;
use App\Repository\RegionRepository;


class AgvoyAppController extends AbstractController
{
    /**
     * @Route("/", name="home", methods="GET" )
     */
    public function base(): Response
    {
        return $this->render('accueil.html.twig');
    }

    /**
     * @Route("/Annonces", name="annonces", methods="GET" )
     */
    public function annonces(RegionRepository $RegionRepository , RoomRepository $RoomRepository, int $i=0): Response
    {
        return $this->render('annonces.html.twig', [
            'rooms'=>$RoomRepository->findAll(),'regions'=>$RegionRepository->findAll(), 'i'=> $i ]);
    }
    
    /**
     * @Route("/agvoy/app", name="agvoy_app", methods="GET" )
     */
    public function index(): Response
    {
        $controller = 'Test' ;
        return $this->render('index.html.twig', 
            ['controller_name' => $controller ]
            );
    }
    
    /**
     * @Route("/Contact", name="contact", methods="GET" )
     */
    public function contact(): Response
    {
        return $this->render('Nouscontacter.html.twig');
    }
    
    /**
     * @Route("/Inscription", name="inscription", methods={"GET","POST"} )
     */
    public function inscription(Request $request): Response
    {
            $client = new Client();
            $form = $this->createForm(ClientType::class, $client);
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($client);
                $entityManager->flush();
                
                return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
            }
            
            return $this->render('inscription.html.twig', [
                'client' => $client,
                'form' => $form->createView(),
            ]);
        }
        
        /**
         * @Route("/Connexion", name="connexion", methods="GET" )
         */
        public function connexion(): Response
        {
            return $this->render('connexion.html.twig');
        }
        
        /**
         * @Route("/reservation/{id}", name="reservationid", methods="GET" )
         */
        public function reservationid(Room $roomid ): Response
        {
            return $this->render('nouvellereservation.html.twig', [
                'roomid' => $roomid,
            ]);
        }
    
}
