<?php

namespace App\Repositories;

use App\Models\QuizAttempt;

class QuizAttemptRepository extends BaseRepository
{
    /**
     * Repository's Constructor
     */
    public function __construct(QuizAttempt $model)
    {
        parent::__construct($model);
    }
}
