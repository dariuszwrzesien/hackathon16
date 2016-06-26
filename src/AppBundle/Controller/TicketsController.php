<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ticket;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\QueryParam;

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
        $repository = $this->getDoctrine()->getRepository('AppBundle\Entity\Ticket');
        $ticket = $repository->findOneById($id);

        return $ticket;
    }

    /**
     * @ApiDoc(
     *  description = "Create new Ticket and store them in database",
     *  resource = true,
     *  input = "AppBundle\Entity\Ticket",
     *  output = "AppBundle\Entity\Ticket",
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      400 = "Returned when data validation fails",
     *  }
     * )
     *
     * @View(serializerGroups={"details"})
     */
    public function postTicketAction(Request $request)
    {
        $ticketData = $userData = $request->request->all();

        return new Response();
    }

    /**
     * @ApiDoc(
     *  description = "Update Ticket's data",
     *  requirements = {
     *     { "name" = "id", "dataType" = "integer", "requirement" = "\d+", "description" = "Ticket's id" }
     *  },
     *  parameters = {
     *      { "name" = "description", "dataType" = "string", "requirement" = "\w+", "required" = true, "format" = "{not blank}" }
     *  },
     *  statusCodes = {
     *      200 = "Returned when successful",
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
        $ticket = new Ticket();

        return $ticket;
    }
}
