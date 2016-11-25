<?php

namespace App\Http\Controllers;

use App\ChampionshipSettings;
use App\Exceptions\TreeGenerationException;
use App\Grade;
use App\Tree;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TreeController extends Controller
{
    /**
     * Display a listing of trees.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $grades = Grade::pluck('name', 'id');
        $tournament = Tree::getTournament($request);
        return view('trees.index', compact('tournament', 'grades'));
    }

    /**
     * Build Tree
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|string
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $tournament = Tree::getTournament($request);
        if (Auth::user()->cannot('generateTree', $tournament)) {
            throw new AuthorizationException();
        }

        foreach ($tournament->championships as $championship) {
            if (!$championship->isRoundRobinType()) {
                $generation = Tree::getGenerationStrategy($championship);
                $generation->championship = $championship;
                try {
                    $tree = $generation->run();
                    $championship->tree = $tree;

                    $settings = $championship->settings ?? new ChampionshipSettings(config('options.default_settings'));
                    Tree::generateFights($tree, $settings);

                    flash()->success(trans('msg.championships_tree_generation_success'));
                } catch (TreeGenerationException $e) {
                    flash()->error($e->message);
                } finally {
//                    return redirect(route('tree.index', $tournament->slug));
                }
            }
        }
        return redirect(route('tree.index', $tournament->slug));
    }
}
