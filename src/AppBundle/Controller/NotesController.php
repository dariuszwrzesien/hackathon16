<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Note;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\View;

class NotesController extends FOSRestController
{
    /**
     * @ApiDoc(
     *   description = "Get all Notes",
     *   output = "AppBundle\Entity\Note",
     *   statusCodes = {
     *     200 = "OK",
     *   }
     * )
     *
     * @View(serializerGroups={"details"})
     */
    public function getNotesAction()
    {
        $note = new Note();
        $note->setDescription('Example description');

        return [$note];
    }

    /**
     * @ApiDoc(
     *   description = "Get Note details",
     *   requirements = {
     *     { "name" = "id", "dataType" = "integer", "requirement" = "\d+", "description" = "Note's id" },
     *   },
     *   output = "AppBundle\Entity\Note",
     *   statusCodes = {
     *     200 = "Returned when note was found",
     *     404 = "Returned when note was not found"
     *   }
     * )
     *
     * @View(serializerGroups={"details"})
     */
    public function getNoteAction($id)
    {
        $note = new Note();
        $note->setDescription('Example description');

        return $note;
    }

    /**
     * @ApiDoc(
     *  description = "Create new Note and store them in database",
     *  resource = true,
     *  input = "AppBundle\Entity\Note",
     *  output = "AppBundle\Entity\Note",
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      400 = "Returned when data validation fails",
     *  }
     * )
     *
     * @View(serializerGroups={"details"})
     */
    public function postNoteAction(Request $request)
    {
        $noteData = $userData = $request->request->all();

        return new Response();
    }

    /**
     * @ApiDoc(
     *  description = "Update Note's data",
     *  requirements = {
     *     { "name" = "id", "dataType" = "integer", "requirement" = "\d+", "description" = "Note's id" }
     *  },
     *  parameters = {
     *      { "name" = "description", "dataType" = "string", "requirement" = "\w+", "required" = true, "format" = "{not blank}" }
     *  },
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      400 = "Returned when data validation fails",
     *      404 = "Returned when note not found",
     *      500 = "Returned when update operation fails"
     *  }
     * )
     *
     * @View(serializerGroups={"update"})
     */
    public function putNoteAction(Request $request, $id)
    {
        $note = new Note();
        $note->setDescription($request->request->get('description'));

        return $note;
    }
}
