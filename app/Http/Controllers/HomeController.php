<?php

namespace App\Http\Controllers;

use Auth;
use App\Repositories\QuestionRepository;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $questionRepository;
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->middleware('auth')->except(['index','show']);
        $this->questionRepository = $questionRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->questionRepository->getQuestionsFeed();
        return view('home', compact('questions'));
    }
}
