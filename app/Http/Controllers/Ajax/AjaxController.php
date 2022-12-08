<?php

namespace App\Http\Controllers\Ajax;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Ajax\BaseController as BaseController;

class AjaxController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function enableColumn(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required',
            'table' => 'required',
            'column' => 'required',
        ])->validate();

        $id = $request->get('id');
        $column = $request->get('column');

        $model = null;
        switch ($request->get('table')) {
            case 'departments':
                $model = Department::find($id);
                break;
            case 'users':
                $model = User::find($id);
                break;
            default:
                break;
        }

        if ($model) {
            $result = $model->update([
                $column => $model[$column] ? 0 : 1
            ]);

            return $this->sendResponse($result, 'successfully.');
        }

        return $this->sendResponse(false, 'successfully.');
    }

}
