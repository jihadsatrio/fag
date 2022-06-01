<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agen;
use App\Models\Nahkoda;
use App\Models\Kapal;
use App\Models\Pembawakapal;
use App\Models\User;
use Illuminate\Http\Request;
use Response;

class AjaxController extends Controller
{
    public function EmailUser(Request $request)
    {
        $users  = User::where('email', $request->emailuser)->first();
        $iduser = $request->iduser;

        if ($users == null)
        {
            $params = true;
        }
        else
        {
            if ($users->id == $iduser)
            {
                $params = true;
            }
            else
            {
                $params = false;
            }
        }
        return Response::json($params);
    }

    public function EmailNahkoda(Request $request)
    {
        $nahkoda  = Nahkoda::where('email', $request->emailnahkoda)->first();
        $idnahkoda = $request->idnahkoda;

        if ($nahkoda == null)
        {
            $params = true;
        }
        else
        {
            if ($nahkoda->id == $idnahkoda)
            {
                $params = true;
            }
            else
            {
                $params = false;
            }
        }
        return Response::json($params);
    }

    public function NidnNahkoda(Request $request)
    {
        $nahkoda  = Nahkoda::where('nidn', $request->nidnnahkoda)->first();
        $idnahkoda = $request->idnahkoda;

        if ($nahkoda == null)
        {
            $params = true;
        }
        else
        {
            if ($nahkoda->id == $idnahkoda)
            {
                $params = true;
            }
            else
            {
                $params = false;
            }
        }
        return Response::json($params);
    }

    public function NameAgen(Request $request)
    {
        $agen  = Agen::where('name', $request->nameagen)->first();
        $idagen = $request->idagen;

        if ($agen == null)
        {
            $params = true;
        }
        else
        {
            if ($agen->id == $idagen)
            {
                $params = true;
            }
            else
            {
                $params = false;
            }
        }
        return Response::json($params);
    }

    public function CodeAgen(Request $request)
    {
        $agen  = Agen::where('code_agen', $request->code_agen)->first();
        $idagen = $request->idagen;

        if ($agen == null)
        {
            $params = true;
        }
        else
        {
            if ($agen->id == $idagen)
            {
                $params = true;
            }
            else
            {
                $params = false;
            }
        }
        return Response::json($params);
    }

    public function CodeKapal(Request $request)
    {
        $kapal  = Kapal::where('code_kapal', $request->code_kapal)->first();
        $idkapal = $request->idkapal;

        if ($kapal == null)
        {
            $params = true;
        }
        else
        {
            if ($kapal->id == $idkapal)
            {
                $params = true;
            }
            else
            {
                $params = false;
            }
        }
        return Response::json($params);
    }

    public function NameKapal(Request $request)
    {
        $kapal  = Kapal::where('name', $request->namekapal)->first();
        $idkapal = $request->idkapal;

        if ($kapal == null)
        {
            $params = true;
        }
        else
        {
            if ($kapal->id == $idkapal)
            {
                $params = true;
            }
            else
            {
                $params = false;
            }
        }
        return Response::json($params);
    }

    public function PembawakapalKapal(Request $request)
    {
        $pembawakapal   = Pembawakapal::where('agen_id', $request->agen)->first();
        $idpembawakapal = $request->idpembawakapal;

        if ($pembawakapal == null)
        {
            $params = true;
        }
        else
        {
            if ($pembawakapal->id == $idpembawakapal)
            {
                $params = true;
            }
            else
            {
                $params = false;
            }
        }
        return Response::json($params);
    }

}
