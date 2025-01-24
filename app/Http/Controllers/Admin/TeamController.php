<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Illuminate\View\View;
use App\Traits\StatusTrait;
use Illuminate\Support\Str;
use App\Traits\ReOrderTrait;
use Illuminate\Http\Request;
use App\Traits\DatatableTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\TeamStoreRequest;
use App\Http\Requests\Admin\TeamUpdateRequest;

class TeamController extends Controller
{
    use StatusTrait, DatatableTrait, ReOrderTrait;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Team::query()->select(['id', 'name', 'image', 'responsibility', 'rank', 'status'])->orderBy('rank','asc')->get();

            $config = [
                'additionalColumns' => [
                    'image' => function ($row) {
                        return view('components.form.table_image', [
                            'url' => $row->image_path,
                        ])->render();
                    },
                ],
                'disabledButtons' => [],
                'model' => 'Team',
                'rawColumns' => ['image'],
                'sortable' => true,
                'routeClass' => null,
            ];

            return $this->getDataTable($request, $data, $config)->make(true);
        }

        return view('admin.team.index', [
            'columns' => ['name', 'image', 'responsibility', 'rank', 'status'],
        ]);
    }
    public function create(): View
    {
        return view('admin.team.create');
    }

    public function store(TeamStoreRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $nextRank = Team::max('rank') + 1;
        $validatedData['rank'] = $nextRank;
        $validatedData['slug'] = Str::slug($request->name) . '-' . Str::random(10);
        $team = Team::create($validatedData);
        if ($request->hasFile('image')) {
            $team->storeImage('image', 'team-images', $request->file('image'));
        }
        return redirect()->route('admin.teams.index')->with('success', 'Team Created Successfully!');
    }

    public function show(Team $team): View
    {
        return view('admin.team.show', compact('team'));
    }

    public function edit(Team $team): View
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(TeamUpdateRequest $request, Team $team): RedirectResponse
    {
        $data = $request->safe()->except('image');
        if ($request->input('image_removed') == 'true') {
            $team->deleteImage('image', 'team-images');
            $data['image'] = null;
        }
        if ($request->name !== $team->name) {
            $data['slug'] = Str::slug($request->name) . '-' . Str::random(10);
        }
        $team->update($data);

        if ($request->hasFile('image')) {
            $team->updateImage('image', 'team-images', $request->file('image'));
        }

        return redirect()->route('admin.teams.index')->with('success', 'Team Updated Successfully!');
    }

    public function destroy(Team $team): RedirectResponse
    {
        if ($team->image) {
            $team->deleteImage('image', 'team-images');
        }

        $team->delete();

        return redirect()->route('admin.teams.index')->with('success', 'Team Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Team', $request->id, $request->status);
    }
    public function rowReOrder(): void
    {
        $re_order = Team::select(['id', 'rank'])->get();
        $this->reOrder($re_order, 'rank');
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            Team::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected teams have been deleted successfully.']);
        } else {
            return response()->json(['error' => 'No teams selected for deletion.'], 400);
        }
    }
}
