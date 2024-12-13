<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Position;


class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        $positions = Position::all();
        return view('members.create', compact('positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'picture' => 'required|url',
            'name' => 'required|min:3|max:255',
            'surname' => 'required|min:3|max:255',
            'position_id' => 'required|exists:positions,id',
            'short_profile' => 'required|min:3|max:255',
        ], [
            'picture.required' => 'Please upload a picture.',
            'picture.url' => 'Picture must be a valid URL.',
            'name.required' => 'Please enter a name.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be no more than 255 characters.',
            'surname.required' => 'Please enter a surname.',
            'surname.min' => 'Surname must be at least 3 characters.',
            'surname.max' => 'Surname must be no more than 255 characters.',
            'position_id.required' => 'Please select a position.',
            'position_id.exists' => 'Selected position does not exist.',
            'short_profile.required' => 'Please enter a short profile.',
            'short_profile.min' => 'Short profile must be at least 3 characters.',
            'short_profile.max' => 'Short profile must be no more than 255 characters.',
        ]);

        Member::create($request->all());
        return redirect()->route('members.create')->with('success', 'Member created successfully');
    }

    public function edit(Member $member)
    {
        $positions = Position::all();
        return view('members.edit', compact('member', 'positions'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'picture' => 'required|url',
            'name' => 'required|min:3|max:255',
            'surname' => 'required|min:3|max:255',
            'position_id' => 'required|exists:positions,id',
            'short_profile' => 'required|min:3|max:255',
        ], [
            'picture.required' => 'Please upload a picture.',
            'picture.url' => 'Picture must be a valid URL.',
            'name.required' => 'Please enter a name.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be no more than 255 characters.',
            'surname.required' => 'Please enter a surname.',
            'surname.min' => 'Surname must be at least 3 characters.',
            'surname.max' => 'Surname must be no more than 255 characters.',
            'position_id.required' => 'Please select a position.',
            'position_id.exists' => 'Selected position does not exist.',
            'short_profile.required' => 'Please enter a short profile.',
            'short_profile.min' => 'Short profile must be at least 3 characters.',
            'short_profile.max' => 'Short profile must be no more than 255 characters.',
        ]);

        $member->update($request->all());
        return redirect(route('dashboard') . '#members')->with('success', 'Member updated successfully');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect(route('dashboard') . '#members')->with('success', 'Member deleted successfully');
    }
}
