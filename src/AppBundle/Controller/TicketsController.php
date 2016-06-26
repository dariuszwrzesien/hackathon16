<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Attachment;
use AppBundle\Entity\Category;
use AppBundle\Entity\Location;
use AppBundle\Entity\Status;
use AppBundle\Entity\Ticket;
use AppBundle\Form\TicketType;
use DateTime;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\FileParam;

class TicketsController extends FOSRestController
{
    /**
     * @ApiDoc(
     *   description = "Get all Tickets",
     *   output = "AppBundle\Entity\Ticket",
     *   statusCodes = {
     *     200 = "OK",
     *   }
     * )
     *
     * @View(serializerGroups={"details"})
     * @QueryParam(name="page", requirements="\d+", default="1", description="Current page")
     * @QueryParam(name="limit", requirements="\d+", default="25", description="Limit of results")
     * @param ParamFetcher $fetcher
     * @return array
     */
    public function getTicketsAction(ParamFetcher $fetcher)
    {
        $tickets = $this->getDoctrine()
            ->getRepository('AppBundle\Entity\Ticket')
            ->findAll($fetcher->get('page'), $fetcher->get('limit'));

        return $tickets->getIterator()->getArrayCopy();
    }

    /**
     * @ApiDoc(
     *   description = "Get Ticket details",
     *   requirements = {
     *     { "name" = "id", "dataType" = "integer", "requirement" = "\d+", "description" = "Ticket's id" },
     *   },
     *   output = "AppBundle\Entity\Ticket",
     *   statusCodes = {
     *     200 = "Returned when ticket was found",
     *     404 = "Returned when ticket was not found"
     *   }
     * )
     *
     * @View(serializerGroups={"details"})
     */
    public function getTicketAction($id)
    {
        return $this->getTicket($id);
    }

    /**
     * @ApiDoc(
     *  description = "Create new Ticket and store them in database",
     *  resource = true,
     *  input = "AppBundle\Entity\Ticket",
     *  output = "AppBundle\Entity\Ticket",
     *  statusCodes = {
     *      201 = "Returned when successful",
     *      400 = "Returned when data validation fails",
     *      410 = "Returned when data write fails"
     *  }
     * )
     *
     * @View(serializerGroups={"details"})
     */
    public function postTicketAction(Request $request)
    {
        $ticketData = $request->request->all();

        $ticket = new Ticket();
        $ticket->setCreated(new DateTime());
        $ticket->setUpdated(new DateTime());
        $ticket->setStatus(Status::WAITING);

        $ticket->setDescription($ticketData['description']);

        $location = new Location();
        $location->setLatitude($ticketData['latitude']);
        $location->setLongitude($ticketData['longitude']);
        $ticket->setLocation($location);

        $category = $this->getDoctrine()->getRepository('AppBundle\Entity\Category')->findOneById($ticketData['category']);
        if ( ! $category) {
            throw $this->createNotFoundException(
                'Invalid category'
            );
        }
        $ticket->setCategory($category);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($ticket);
        $manager->flush();

        return new Response($ticket->getId(), 201);
    }

    /**
     * @ApiDoc(
     *  description = "Add attachment for ticket",
     *  resource = true,
     *  output = "AppBundle\Entity\Ticket",
     *  statusCodes = {
     *      201 = "Returned when successful",
     *      400 = "Returned when data validation fails",
     *      410 = "Returned when data write fails"
     *  }
     * )
     *
     * @FileParam(name="attachment", image=true, requirements={"maxSize"="5m"}, strict=true)
     * @param $id
     * @param ParamFetcher $fetcher
     * @return Response
     *
     * @View(serializerGroups={"details"})
     */
    public function postTicketAttachmentAction($id, ParamFetcher $fetcher)
    {
        $ticket = $this->getTicket($id);

        $file = $fetcher->get('attachment');
        $filePath = $this->container->getParameter('upload_dir');
        $fileName = md5(microtime()) .'.' . $file->guessExtension();
        $file->move($filePath, $fileName);

        $attachment = new Attachment();
        $attachment->setPath($filePath);
        $attachment->setFileName($fileName);
        $attachment->setTicket($ticket);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($attachment);
        $manager->flush();

        return new Response($ticket->getId(), 201);
    }

    /**
     * @ApiDoc(
     *  description = "Update Ticket's data",
     *  resource = true,
     *  requirements = {
     *     { "name" = "id", "dataType" = "integer", "requirement" = "\d+", "description" = "Ticket's id" }
     *  },
     *  parameters = {
     *      { "name" = "status",      "dataType" = "integer", "requirement" = "\w+", "required" = false },
     *  },
     *  statusCodes = {
     *      202 = "Returned when successful",
     *      400 = "Returned when data validation fails",
     *      404 = "Returned when ticket not found",
     *      500 = "Returned when update operation fails"
     *  }
     * )
     *
     * @View(serializerGroups={"update"})
     */
    public function putTicketAction(Request $request, $id)
    {
        $ticketData = $request->request->all();

        $ticket = $this->getTicket($id);
        $em = $this->getDoctrine()->getManager();

        (isset($ticketData['status']))?$ticket->setStatus((int)$ticketData['status']):null;

        $em->persist($ticket);
        $em->flush();

        return new Response(202);
    }

    /**
     * @param $id
     * @return Ticket
     */
    private function getTicket($id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle\Entity\Ticket');
        $ticket = $repository->findOneById($id);
        if (!$ticket) {
            throw $this->createNotFoundException(
                'No ticket found for id '.$id
            );
        }

        return $ticket;
    }
}
