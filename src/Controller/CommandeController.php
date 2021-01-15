<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use App\Repository\StockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/commande")
 */
class CommandeController extends AbstractController
{
    /**
     * @Route("/", name="commande_index", methods={"GET"})
     */
    public function index(CommandeRepository $commandeRepository, StockRepository $stockRepository, Request $request): Response
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);

        $panierWithData = [];
        

        foreach($panier as $id => $quantite) {
            $panierWithData[] = [
                'stock' => $stockRepository->find($id),
                'quantiteDansPanier' => $quantite, 
            ];
        }
        $session->set('panierWithData', $panierWithData);

        return $this->render('commande/panier.html.twig', [
            //'commandes' => $commandeRepository->findAll(),
            'panier' => $panierWithData,
        ]);

        // dd($panierWithData);
    }

    /**
     * @Route("/new", name="commande_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserInterface $user = null): Response
    {
        if($user == null) {
            return $this->redirectToRoute('app_register');
        } 
        else {
            $session = $request->getSession();
            $panierWithData = $session->get('panierWithData', []);
            if(!empty($panierWithData)) {
                $userId = $this->getUser()->getId();
                $entityManager = $this->getDoctrine()->getManager();
                $commande = new Commande();
                foreach($panierWithData as $item) {
                    $stock = $item[array_key_first($item)];
                    $commande->addStock($stock);
                }
                $commande->setUtilisateur($user);
                $entityManager->persist($commande);
                $entityManager->flush();
    
                $session->set('panier', []);
                $session->set('panierWithData', []);
            }
            else {
                return $this->redirectToRoute('magasin_index');
            }
            
        }
        dd($commande);
    }

    /**
     * @Route("/{id}", name="commande_show", methods={"GET"})
     */
    public function show(Commande $commande): Response
    {
        return $this->render('commande/show.html.twig', [
            'commande' => $commande,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commande_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commande $commande): Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande_index');
        }

        return $this->render('commande/edit.html.twig', [
            'commande' => $commande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commande $commande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_index');
    }

    /**
     * @Route("/add/{id}", name="commande_add")
     */
    public function add($id, Request $request, StockRepository $stockRepository) {
        $session = $request->getSession();
        $panier = $session->get('panier', []);
        if(!empty($panier[$id])) {
            $panier[$id]++;
        }
        else {
            $panier[$id] = 1;
        }
        $session->set('panier', $panier);

        // return $this->render('commande/test.html.twig', [
        //     'id' => $id,
        //     'panier' => $panier,
        // ]);
        return $this->redirectToRoute('commande_index');

        //dd($panierWithData);
    }

    /** 
     * @Route("/remove/{id}", name="commande_remove") 
     */
    public function remove($id, Request $request) {
        $session = $request->getSession();
        $panier = $session->get('panier', []);
        if(!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('commande_index');
    }
}
