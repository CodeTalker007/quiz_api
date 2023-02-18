<?php

namespace App\Repositories;

use App\Models\Quiz;

class QuizRepository extends BaseRepository
{
    /**
     * Repository's Constructor
     */
    public function __construct(Quiz $model)
    {
        parent::__construct($model);
    }
}
