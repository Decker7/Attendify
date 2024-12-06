<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function destroy(Invitation $invitation)
    {
        $invitation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Invitation removed successfully.'
        ]);
    }
}

