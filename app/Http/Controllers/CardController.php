<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        //
         // We first check which action is fired from the frontEnd from the option selected
        // 1:Grant & register, 2:Reject, 3:Block, 4:Restore
        $action = $request->input('card-action');
        switch ($action) {
            case 1:
            // With Case 1 it means the action fired is to Grant the card and register it
            {
                $unique_id = $request->input('unique_id');
                $pin = $request->input('pin');
                
                $card_update = Card::where('id', $card->id)
                ->update([
                    'unique_id' => $unique_id,
                    'balance' => 0,
                    'passcode' => $pin,
                    'status' => 1
                ]);
                if($card_update)
                {
                    return redirect()->route('commuters.index')->with('success', 'Passenger updated successfully');
                }
                return back()->withInput()->with('danger', 'Passenger could not be updated');
            }

            break;

            case 2:
            // With Case 2 it means the action fired is to reject the card application
            {
                
                $card_update = Card::where('id', $card->id)
                ->update([
                    'status' => 2
                ]);
                if($card_update)
                {
                    return redirect()->route('commuters.index')->with('success', "Card's application request rejected!");
                }
                return back()->withInput()->with('danger', 'Action Failed!');
            }
            break;

            case 3:
            // With Case 3 it means we got to block an existing card
            {
                $card_update = Card::where('id', $card->id)
                ->update([
                    'status' => 3
                ]);
                if($card_update)
                {
                    return redirect()->route('commuters.index')->with('success', "Card successfully blocked!");
                }
                return back()->withInput()->with('danger', 'Action Failed!');
            }
            break;

            case 4:
            // With Case 4 it means the card needs to be restored
            {
                $card_update = Card::where('id', $card->id)
                ->update([
                    'status' => 4
                ]);
                if($card_update)
                {
                    return redirect()->route('commuters.index')->with('success', "Card successfully restored!");
                }
                return back()->withInput()->with('danger', 'Action Failed!');
            }

            break;


            default:
                # code...
            break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        //
    }
}
