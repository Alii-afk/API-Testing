<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 * path="/",
 * summary="Welcome Page",
 * description="Welcome Page",
 * operationId="welcomePage",
 * tags={"Welcome"},
 * @OA\Response(
 *    response=100,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 * 
 *@OA\Post(
 * path="/users/register",
 * summary="Sign Up",
 * description="Sign Up email, password",
 * operationId="authReg",
 * tags={"Login/Registeration"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"username","name","email","password"},
 *       @OA\Property(property="username", type="string", format="text", example="john_99"),
 *       @OA\Property(property="name", type="string", format="text", example="John"),
 *       @OA\Property(property="email", type="string", format="email", example="John@mail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, Invalid email address or password. Please try again")
 *        )
 *     )
 * )
 * 
 * @OA\Get(
 * path="/users",
 * summary="Find Users",
 * description="Find All Users",
 * operationId="findAllUsers",
 * tags={"Apis"},
 * @OA\Response(
 *    response=100,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )

 * @OA\Get(
 * path="/users/{id}",
 * summary="Find Single User",
 * description="Find Single Users",
 * operationId="findSingleUsers",
 * tags={"Apis"},
 * @OA\Parameter(
 *    description="ID of User",
 *    in="path",
 *    name="id",
 *    required=true,
 *    example="1",
 *     @OA\Schema(
 *       type="integer",
 *       format="int64"
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 *
 * @OA\Get(
 * path="/users/bydate",
 * summary="Find User By Date",
 * description="Find User By Date",
 * operationId="findUserByDate",
 * tags={"Apis"},
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 * 
 * @OA\Delete(
 * path="/users/delete",
 * summary="Delete User By Id",
 * description="Delete User By Id",
 * operationId="deleteUserById",
 * tags={"Apis"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"id"},
 *       @OA\Property(property="id", type="integer", format="int64", example="1"),
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 *
 * 
 * @OA\Put(
 * path="/users/{id}",
 * summary="Update Single User",
 * description="Update Single Users",
 * operationId="updateSingleUsers",
 * tags={"Apis"},
 * @OA\Parameter(
 *    description="ID of User",
 *    in="path",
 *    name="id",
 *    required=true,
 *    example="1",
 *     @OA\Schema(
 *       type="integer",
 *       format="int64"
 *    ),
 * ),
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       @OA\Property(property="name", type="string", format="text", example="John"),
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 * 
 */



class UserController extends Controller
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
    public function create(UserRequest $request)
    {
        $user = User::create($request->validated());
        return redirect('/')->with('success', "Account successfully registered.");
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $from = date('2022-07-01');
        $to = date('2022-07-03');

        // $from = $request->start_date;
        // $to =  $request->end_date;

        $users = User::whereBetween('created_at', [$from,  $to])
            ->get();

        return $users;
    }

    public function showuser(Request $request)
    {
        $users = User::all()->where('id', $request->id)->first();
        return $users;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user->id != $request->id) {
            return abort(403, 'Unauthorized action.');
        }
        $user->update($request->all());
        return "Success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $user = User::where('id', $request->id)->first();
        $user->status =  "1";
        $user->save();
        return "Success";
    }
}
