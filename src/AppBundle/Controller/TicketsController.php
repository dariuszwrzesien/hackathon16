<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ticket;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\View;

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
     */
    public function getTicketsAction()
    {
        $ticket = new Ticket();
        $ticket->description = 'dasda sdasdas';

        return [$ticket];
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
        $ticket = new Ticket();

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
