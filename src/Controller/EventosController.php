<?php

namespace App\Controller;

use App\Entity\Eventos;
use App\Entity\EventosPessoas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class EventosController extends AbstractController
{
    /**
     * @Route("/eventos", name="eventos")
     */
    public function index()
    {
        $session = $this->get('session');
        $session->start();

        file_put_contents('/tmp/drk',$session->getId(), FILE_APPEND);

        $jsonResponse = [];
        $repositoryEventos = $this->getDoctrine()->getRepository("App:Eventos");
        $listEventos = $repositoryEventos->findBy(array(), array('ideventos' => 'DESC'));

        foreach ($listEventos as $id => $evento) {
            $jsonResponse[] = array(
                "name" => $evento->getTitulo(),
                "id" => $evento->getId(),
                "latitude" => $evento->getLatitude(),
                "longitude" => $evento->getLongitude(),
                "totalPessoas" => count($evento->getPesssoas())
            );
        }

        return $this->json($jsonResponse);
    }

    /**
     * @Route("/eventos/dados/{eventoId}", name="eventos_dados")
     */
    public function dados($eventoId)
    {
        $repositoryEventos = $this->getDoctrine()->getRepository("App:Eventos");

        /**
         * @var $evento Eventos
         */
        $evento = $repositoryEventos->find($eventoId);

        return $this->json([
            "id" => $evento->getId(),
            "titulo" => strtoupper($evento->getTitulo()),
            "latitude" => $evento->getLatitude(),
            "longitude" => $evento->getLongitude(),
            "totalPessoas" => count($evento->getPesssoas()),
        ]);
    }

    /**
     * @Route("/eventos/pesssoas/{eventoId}", name="eventos_pessoas")
     */
    public function pessoas($eventoId)
    {
        $jsonResponse = [];
        $repositoryEventos = $this->getDoctrine()->getRepository("App:Eventos");
        $repositoryPessoas = $this->getDoctrine()->getRepository("App:EventosPessoas");
        $evento = $repositoryEventos->find($eventoId);

        if (!$evento) {
            throw new \Exception("Invalid eventoId");
        }

        $pessoas = $repositoryPessoas->findByevento($evento);

        foreach ($pessoas as $id => $pessoa) {
            $jsonResponse[] = array(
                "id" => $pessoa->getId(),
                "nome" => $pessoa->getNome(),
                "latitude" => $pessoa->getLatitude(),
                "longitude" => $pessoa->getLongitude()
            );
        }

        return $this->json($jsonResponse);
    }

    /**
     * @Route("/eventos/register/{eventoId}/{deviceId}", name="eventos_pessoa_register")
     */
    public function pessoaRegister($eventoId, $deviceId)
    {
        $responseResult = true;
        $repositoryEventos = $this->getDoctrine()->getRepository("App:Eventos");
        $repositoryPessoaEvento = $this->getDoctrine()->getRepository("App:EventosPessoas");

        /**
         * @var $evento Eventos
         */
        $evento = $repositoryEventos->find($eventoId);

        $result = $repositoryPessoaEvento->findOneBy(array(
           "evento" =>  $evento,
            "deviceId" => $deviceId
        ));

        $dataRequest = Request::createFromGlobals();

        if ($dataRequest->getMethod() == 'POST') {
            $entityManager = $this->getDoctrine()->getManager();

            if ($result) {
                $pessoa = $result;
                $pessoa->setLatitude($dataRequest->get('latitude'));
                $pessoa->setLongitude($dataRequest->get('longitude'));
            } else {
                $pessoa = new EventosPessoas();
                $pessoa->setNome($deviceId);
                $pessoa->setDeviceId($deviceId);
                $pessoa->setEvento($evento);
                $pessoa->setLatitude($dataRequest->get('latitude'));
                $pessoa->setLongitude($dataRequest->get('longitude'));
            }

            $entityManager->persist($pessoa);
            $entityManager->flush();
        }

        return $this->json(array("response" => $responseResult));
    }

    /**
     * @Route("/eventos/create", name="eventos_create")
     */
    public function create()
    {
        $dataRequest = Request::createFromGlobals();

        if ($dataRequest->getMethod() == 'POST') {
            $entityManager = $this->getDoctrine()->getManager();
            $newEvent = new Eventos();
            $newEvent->setLongitude($dataRequest->get('longitude'));
            $newEvent->setLatitude($dataRequest->get('latitude'));
            $newEvent->setTitulo($dataRequest->get('titulo'));
            $startDate = time();
           $dataAdd = date('Y-m-d H:i:s', strtotime('+1 day', $startDate));
            $newEvent->setExpira(new \DateTime(dataAdd));


            $entityManager->persist($newEvent);
            $entityManager->flush();

            return $this->json(array("eventCreated" => $newEvent->getId()));
        }

        return $this->json(array("eventCreated" => false));
    }
}
