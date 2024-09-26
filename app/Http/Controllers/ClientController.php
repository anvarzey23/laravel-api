<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
       $clients = Client::all();

       return $clients;
    }

    public function show(Client $client)
    {

        return $client;

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'unique:clients'],
            'country' => 'max:255',
            'language' => ['required', 'in:Spanish,English,Portuguese']
        ]);

        if ($validator->fails()) {
            // abort(400);

            return response()->json([
                'error' => $validator->errors()
            ],
            400
            );
        }

        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
            'language' => $request->language
        ]);

        return response('Client created successfully!', 201);

    }

    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'unique:clients'],
            'country' => 'max:255',
            'language' => ['required', 'in:Spanish,English,Portuguese']
        ]);

        if ($validator->fails()) {
            // abort(400);

            return response()->json([
                'error' => $validator->errors()
            ],
            400
            );
        }

        $client->name = $request->name;
        $client->email = $request->email;
        $client->country = $request->country;
        $client->language = $request->language;

        $client->save();

        return response('Client updated successfully!');

    }

    public function updateSpecific(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'email' => ['email', 'unique:clients'],
            'country' => 'max:255',
            'language' => ['in:Spanish,English,Portuguese']
        ]);

        if ($validator->fails()) {
            // abort(400);

            return response()->json([
                'error' => $validator->errors()
            ],
            400
            );
        }

        if ($request->has('name')) {
            $client->name = $request->name;
        }

        if ($request->has('email')) {
            $client->email = $request->email;
        }

        if ($request->has('country')) {
            $client->country = $request->country;
        }

        if ($request->has('language')) {
            $client->language = $request->language;
        }

        $client->save();

        return response('Client updated successfully!');

    }

    public function destroy(Client $client)
    {
        $client->delete();

        return response('Client deleted successfully!', 204);
    }
}
