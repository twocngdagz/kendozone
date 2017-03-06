<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Fight;
use App\Grade;
use App\Round;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Xoco70\KendoTournaments\Exceptions\TreeGenerationException;
use Xoco70\KendoTournaments\Models\ChampionshipSettings;
use Xoco70\KendoTournaments\TreeGen\TreeGen;

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

        $grades = Grade::getAllPlucked();
        $tournament = Round::getTournament($request);
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
        $tournament = Round::getTournament($request);
        if (Auth::user()->cannot('store', [Round::class, $tournament])) {
            throw new AuthorizationException();
        }
        foreach ($tournament->championships as $championship) {
            $settings = $championship->settings ?? new ChampionshipSettings(config('options.default_settings'));
            $generation = new TreeGen($championship, null, $settings);
            try {

                $tree = $generation->run();

                Round::generateFights($tree, $settings, $championship);
                flash()->success(trans('msg.championships_tree_generation_success'));

            } catch (TreeGenerationException $e) {
                flash()->error($e->message);
            } finally {
//                    return redirect(route('tree.index', $tournament->slug));

            }

        }

        return redirect(route('tree.index', $tournament->slug))->with('activeTreeTab', $request->activeTreeTab);
    }

    public function single(Request $request)
    {
        $championship = Championship::find($request->championship);
        $grades = Grade::getAllPlucked();
        return view('pdf.tree', compact('championship', 'grades'));
    }

    public function update(Request $request)
    {

        $fights = $request->fights;
        dd($fights);
        foreach ($fights as $fightName){
            if ($fightName != null){
//                $fight = Fight::where('')
            }
        }

    }

}
