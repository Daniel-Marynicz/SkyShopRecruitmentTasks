<?php

declare(strict_types=1);

namespace App\Tasks\Task01;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function strpos;

class Task01Controller extends AbstractFOSRestController
{
    /**
     * Returns information whether string a contains b
     *
     * @Route("task01", methods={"GET"})
     * OA\Get(
     *      path="/task01",
     * )
     * @OA\Tag(name="Task01")
     * @OA\Response(
     *     response=200,
     *     description="Returns information whether string a contains b",
     *     @OA\JsonContent(ref=@Model(type=Task01DTO::class))
     * )
     * @OA\Parameter(
     *     name="a",
     *     in="query",
     *     example="The best rpg game is the witcher 3"
     * )
     * @OA\Parameter(
     *     name="b",
     *     in="query",
     *     example="best"
     * )
     * @Rest\QueryParam(
     *     name="a",
     *     description="The a get parameter",
     *     allowBlank=false,
     *     nullable=false
     * )
     * @Rest\QueryParam(
     *     name="b",
     *     description="The b get parameter",
     *     allowBlank=false,
     *     nullable=false
     *
     * )
     */
    public function getTask01Action(string $a, string $b) : Response
    {
        $result = new Task01DTO(
            $this->isAContainsB($a, $b)
        );

        return $this->handleView(
            $this->view(
                $result,
                Response::HTTP_OK
            )
        );
    }

    private function isAContainsB(string $a, string $b)
    {
        if (empty($b) || empty($a)) {
            return false;
        }

        return strpos($b, $a) !== false;
    }
}
