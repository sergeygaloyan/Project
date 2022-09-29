<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainerRequest;
use App\Models\Trainer;
use App\Models\Trainer_field;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TrainerController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/trainers",
     *      tags={"Trainers"},
     *      summary="Get list of trainers",
     *      description="Returns list of trainers",
     *      security={ {"sanctum": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(@OA\Schema(
     *              type="object",
     *              example={"email": "ex@gmail.com", "firstName": "Name"}
     *          ))
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *     @OA\Response(
     *          response=400,
     *          description="Trainer not found."
     *      )
     * )
     */
    public function index()
    {
        $trainers = User::all()->where('role_id', "2");
        return response()->json(['trainers' => $trainers]);
    }

    /**
     * @OA\Post(
     *      path="/api/trainers",
     *      operationId="storeTrainers",
     *      tags={"Trainers"},
     *      summary="Store new trainer",
     *      description="Returns trainer data",
     *      security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name","role_id","email","password", "phone"},
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="role_id", type="integer"),
     *               @OA\Property(property="password", type="password"),
     *               @OA\Property(property="phone", type="number"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(TrainerRequest $request)
    {
        if ($request->role_id == "2") {
            $trainer = new User();
            $trainer->name = $request->name;
            $trainer->email = $request->email;
            $trainer->role_id = $request->role_id;
            $trainer->password = Hash::make($request->password);
            $trainer->phone = $request->phone;
            $trainer->save();
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully'
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User is been trainer only'
            ]);
        }
    }
    /**
     * @OA\Get(
     *      path="/api/trainers/{id}",
     *      operationId="getTrainer",
     *      tags={"Trainers"},
     *      summary="Get trainer information",
     *      description="Returns trainer data",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Trainer id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show($id)
    {
        $trainer = User::find($id);
        if($trainer->role_id == 2){
            return response()->json([
                'status' => true,
                'trainer' => $trainer
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'User is been trainer only'
            ]);
        }
    }


    /**
     * @OA\Put(
     *      path="/api/trainers/{id}",
     *      tags={"Trainers"},
     *      summary="Update existing trainer",
     *      description="Returns updated trainer data",
     *      security={ {"sanctum": {} }},
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="Trainer id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *     @OA\RequestBody(
     *    required=true,
     *    description="Pass user registration credentials",
     *    @OA\JsonContent(
     *       required={"name","email","password","phone","role_id"},
     *       @OA\Property(property="name", type="string", example="Anna"),
     *       @OA\Property(property="email", type="string", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", example="FFff22"),
     *       @OA\Property(property="phone", type="string", example="094415263"),
     *       @OA\Property(property="role_id", type="integer", example=1),
     *    ),
     * ),
     *
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *           @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *       ),
     *
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Content"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(Request $request, $id)
    {
        $trainer = User::find($id);
        if($trainer->role_id == 2)
        {
            $trainer->name = $request->name;
            $trainer->email = $request->email;
            $trainer->role_id = $request->role_id;
            $trainer->password = $request->password;
            $trainer->phone = $request->phone;
            $trainer->save();
            return response()->json(
                ['status' => true,
                    'trainer' => $trainer]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'User is been trainer only'
            ]);
        }

    }
    /**
     * @OA\Delete(
     *      path="/api/trainer/{id}",
     *      operationId="deleteTrainer",
     *      tags={"Trainers"},
     *      summary="Delete existing trainer",
     *      description="Deletes a record and returns no content",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Trainer id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json('Deleted');
    }
}
