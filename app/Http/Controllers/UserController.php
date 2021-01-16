<?php

namespace App\Http\Controllers;

use Aginev\Datagrid\Datagrid;
use App\Models\User;
use Illuminate\Http\Request;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct() {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::paginate(25);

        $grid = new Datagrid($user, $request->get('f', []));

        $grid->setColumn('name', 'Full name')
            ->setColumn('email', 'Email address')
            ->setActionColumn([
                'wrapper' => function ($value, $row) use ($user, $grid) {
                    return '<a href="' . route('user.edit', [$row->id]) . '" title="Edit" ><i class="fas fa-edit text-success iconFa"></i></a>
                    <a href="' . route('user.delete', $row->id) . '" title="Delete" cata-method="DELETE"  data-confirm="Are you sure ?"><i class="far fa-minus-square text-danger iconFa"></i></a>'
                        ;
                }
            ]);

            return view('user.index', [
                'grid' => $grid]);

    }

    public function indexHome()
    {

        return view('home');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create', [
            'action' => route('user.store'),
            'method' => 'post'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->save();
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->password = '';
        return view('user.edit', [
            'action' => route('user.update',$user->id),
            'method' => 'put',
            'model' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
           'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:6|confirmed']);

        $user->update($request->all());
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}
