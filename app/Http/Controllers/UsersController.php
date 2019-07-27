<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;

class UsersController extends Controller
{
    private $userRepo;
    
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepo = $userRepository;
    }


    public function index()
    {
//        return response()->json(['data'=>'some data here']);
    }

    public function show($id)
    {
        $this->apiResponse['success'] = FALSE;
        $this->apiResponse['service_name'] = "User Details";

        $user = $this->userRepo->find($id);

        if ($user != null) {
            $this->apiResponse['success'] = TRUE;
            return $this->sendResponse('User retrieved successfully.', $user);
        }
        return $this->sendResponse('User not found!','',404);
    }

}
