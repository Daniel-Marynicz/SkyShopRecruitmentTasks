<?php

declare(strict_types=1);

namespace App\Tasks\Task01;

use OpenApi\Annotations as OA;

class Task01DTO
{
    /**
     * @OA\Property(
     *     type="bool",
     *     description="The unique identifier of the user.",
     *     example=true
     *
     * )
     */
    public bool $bHasAText;

    public function __construct(bool $bHasAText)
    {
        $this->bHasAText = $bHasAText;
    }
}
