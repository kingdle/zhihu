<?php
/**
 * Created by PhpStorm.
 * User: maxdata
 * Date: 17/04/2017
 * Time: 10:17 PM
 */

namespace App\Repositories;
use App\Question;
use App\Topic;

class QuestionRepository
{
    public function byIdWithTopics($id)
    {
        return Question::where('id',$id)->with('topics')->first();

    }

    public function create(array $attributes)
    {
        return Question::create($attributes);
    }

    public function byID($id)
    {
        return Question::find($id);
    }

    public function getQuestionsFeed()
    {
        return Question::published()->latest('updated_at')->with('user')->get();
    }

    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function ($topic){
            if(is_numeric($topic)){
                return (int) $topic;
            }
            $newTopic = Topic::create(['name' => $topic,'question_count' => 1]);
            return $newTopic->id;
        })->toArray();
    }
}