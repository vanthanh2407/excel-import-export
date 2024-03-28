<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Exception;

class GroupController extends Controller
{
    public function index()
    {
        try {
            $groups = Group::all();
            return response()->json(['message' => 'Groups fetched successfully', 'data' => $groups]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch groups.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $group = Group::find($id);
            if ($group) {
                return response()->json(['message' => 'Group details fetched successfully', 'data' => $group]);
            } else {
                return response()->json(['error' => 'Group not found.'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch group details.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'group_name' => 'required',
                'title' => 'required',
                'content' => 'required',
            ]);

            $group = Group::create($validatedData);
            return response()->json(['message' => 'Group created successfully', 'data' => $group], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create group.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $group = Group::findOrFail($id);
            $group->update($request->all());
            return response()->json(['message' => 'Group updated successfully', 'data' => $group], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update group.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Group::findOrFail($id)->delete();
            return response()->json(['message' => 'Group deleted successfully'], 204);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete group.'], 500);
        }
    }
}
