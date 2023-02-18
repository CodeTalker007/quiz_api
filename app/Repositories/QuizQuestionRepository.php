<?php

namespace App\Repositories;

use App\Models\QuizQuestion;

class QuizQuestionRepository extends BaseRepository
{
    /**
     * Repository's Constructor
     */
    public function __construct(QuizQuestion $model)
    {
        parent::__construct($model);
    }
}
