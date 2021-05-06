<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Personne;
use Symfony\Component\HttpFoundation\JsonResponse;

class PersonneController extends AbstractController
{
	/**
	* @Route("/save")
	*/
		
	public function save()
	{
		$entityManager = $this->getDoctrine()->getManager();

		$date = new \DateTime($_GET['date']);

		$personne = new Personne();
		$personne->setNom($_GET['nom']);
		$personne->setPrenom($_GET['prenom']);
		$personne->setDate($date);

		$entityManager->persist($personne);

		$today = new \DateTime('today');
		$age = $date->diff($today)->y;

		if ($age < 150)
		{           
			$entityManager->flush();
		}
		else
		{
			return new Response('La personne a plus de 150 ans et ne peut donc pas être enregistrée');
		}

		return new Response('La personne a bien été enregistrée');
	}

	/**
	* @Route("/show")
	*/
	public function show()
	{


		$personnes = $this->getDoctrine()->getRepository(Personne::class)->findAll();
		$response = array();
		foreach($personnes as $personne)
		{
			$response[] = array(
				'nom' => $personne->getNom(),
				'prenom' => $personne->getPrenom(),
				'date' => $personne->getDate(),
				'age' => $personne->getAge()
			);
		}
		return new JsonResponse($response);
	}
}